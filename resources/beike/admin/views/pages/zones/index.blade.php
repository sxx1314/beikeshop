@extends('admin::layouts.master')

@section('title', __('admin/common.zone'))

@section('content')
  <div id="tax-classes-app" class="card" v-cloak>
    <div class="card-body h-min-600">
      <div class="d-flex justify-content-between mb-4">
        <button type="button" class="btn btn-primary" @click="checkedCreate('add', null)">{{ __('common.add') }}</button>
      </div>
      <div class="table-push">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>{{ __('common.name') }}</th>
              <th>{{ __('currency.code') }}</th>
              <th>{{ __('common.created_at') }}</th>
              <th>{{ __('common.updated_at') }}</th>
              <th>{{ __('common.sort_order') }}</th>
              <th>{{ __('common.status') }}</th>
              <th class="text-end">{{ __('common.action') }}</th>
            </tr>
          </thead>
          <tbody v-if="zones.data.length">
            <tr v-for="zone, index in zones.data" :key="index">
              <td>@{{ zone.id }}</td>
              <td>@{{ zone.name }}</td>
              <td>@{{ zone.code }}</td>
              <td>@{{ zone.created_at }}</td>
              <td>@{{ zone.updated_at }}</td>
              <td>@{{ zone.sort_order }}</td>
              <td>
                <span v-if="zone.status" class="text-success">{{ __('common.enable') }}</span>
                <span v-else class="text-secondary">{{ __('common.disable') }}</span>
              </td>
              <td class="text-end">
                <button class="btn btn-outline-secondary btn-sm" @click="checkedCreate('edit', index)">{{ __('common.edit') }}</button>
                <button class="btn btn-outline-danger btn-sm ml-1" type="button" @click="deleteCustomer(zone.id, index)">{{ __('common.delete') }}</button>
              </td>
            </tr>
          </tbody>
          <tbody v-else><tr><td colspan="7" class="border-0"><x-admin-no-data /></td></tr></tbody>
        </table>
      </div>

      <el-pagination v-if="zones.data.length" :pager-count="5" layout="prev, pager, next" background :page-size="zones.per_page" :current-page.sync="page"
        :total="zones.total"></el-pagination>
    </div>

    <el-dialog title="{{ __('admin/common.zone') }}" :visible.sync="dialog.show" width="620px"
      @close="closeCustomersDialog('form')" :close-on-click-modal="false">

      <el-form ref="form" :rules="rules" :model="dialog.form" label-width="148px">
        <el-form-item label="{{ __('admin/zone.zone_name') }}" prop="name">
          <el-input v-model="dialog.form.name" placeholder="{{ __('admin/zone.zone_name') }}"></el-input>
        </el-form-item>

        <el-form-item label="{{ __('currency.code') }}">
          <el-input v-model="dialog.form.code" placeholder="{{ __('currency.code') }}"></el-input>
        </el-form-item>

        <el-form-item label="{{ __('admin/zone.country_of_origin') }}" prop="country_id">
          <el-select v-model="dialog.form.country_id" placeholder="{{ __('admin/zone.country_of_origin') }}">
            <el-option
              v-for="item in countries"
              :key="item.id"
              :label="item.name"
              :value="item.id">
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item label="{{ __('common.sort_order') }}">
          <el-input v-model="dialog.form.sort_order" placeholder="{{ __('common.sort_order') }}"></el-input>
        </el-form-item>


        <el-form-item label="{{ __('common.status') }}">
          <el-switch v-model="dialog.form.status" :active-value="1" :inactive-value="0"></el-switch>
        </el-form-item>

        <el-form-item class="mt-5">
          <el-button type="primary" @click="addFormSubmit('form')">{{ __('common.save') }}</el-button>
          <el-button @click="closeCustomersDialog('form')">{{ __('common.cancel') }}</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
  </div>
@endsection

@push('footer')
  @include('admin::shared.vue-image')

  <script>
    new Vue({
      el: '#tax-classes-app',

      data: {
        countries: @json($countries ?? []),
        zones: @json($zones ?? []),

        page: 1,

        dialog: {
          show: false,
          index: null,
          type: 'add',
          form: {
            id: null,
            name: '',
            code: '',
            country_id: '',
            sort_order: '',
            status: 1,
          },
        },

        rules: {
          name: [{required: true, message: '{{ __('common.error_required', ['name' => __('admin/zone.zone_name')]) }}', trigger: 'blur'}, ],
          country_id: [{required: true, message: '{{ __('admin/zone.error_country') }}', trigger: 'blur'}, ],
        }
      },

      watch: {
        page: function() {
          this.loadData();
        },
      },

      methods: {
        loadData() {
          $http.get(`zones?page=${this.page}`).then((res) => {
            this.zones = res.data.zones;
          })
        },

        checkedCreate(type, index) {
          this.dialog.show = true
          this.dialog.type = type
          this.dialog.index = index

          if (type == 'edit') {
            this.dialog.form = JSON.parse(JSON.stringify(this.zones.data[index]));
          }
        },

        statusChange(e, index) {
          const id = this.zones.data[index].id;

          // $http.put(`languages/${id}`).then((res) => {
          //   layer.msg(res.message);
          // })
        },

        addFormSubmit(form) {
          const self = this;
          const type = this.dialog.type == 'add' ? 'post' : 'put';
          const url = this.dialog.type == 'add' ? 'zones' : 'zones/' + this.dialog.form.id;

          this.$refs[form].validate((valid) => {
            if (!valid) {
              this.$message.error('{{ __('common.error_form') }}');
              return;
            }

            $http[type](url, this.dialog.form).then((res) => {
              this.$message.success(res.message);
              if (this.dialog.type == 'add') {
                // this.zones.data.push(res.data)
                this.loadData();
              } else {
                this.zones.data[this.dialog.index] = res.data
              }

              this.dialog.show = false
            })
          });
        },

        deleteCustomer(id, index) {
          const self = this;
          this.$confirm('{{ __('common.confirm_delete') }}', '{{ __('common.text_hint') }}', {
            confirmButtonText: '{{ __('common.confirm') }}',
            cancelButtonText: '{{ __('common.cancel') }}',
            type: 'warning'
          }).then(() => {
            $http.delete('zones/' + id).then((res) => {
              this.$message.success(res.message);
              this.loadData();
              // self.country.data.splice(index, 1)
            })
          }).catch(()=>{})
        },

        closeCustomersDialog(form) {
          this.$refs[form].resetFields();
          Object.keys(this.dialog.form).forEach(key => this.dialog.form[key] = '')
          this.dialog.show = false
        }
      }
    })
  </script>
@endpush
