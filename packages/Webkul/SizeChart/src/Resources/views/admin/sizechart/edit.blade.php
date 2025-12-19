<x-admin::layouts>
    <x-slot:title>
        {{ __('sizechart::app.sizechart.template.edit-temp-title') }}
    </x-slot>

    @push('css')
        <style>
            [v-cloak] {
                display: none;
            }
            .custom_input {
                height: 28px;
                text-align: center;
                font-weight: bold;
            }
            .custom_input_t {
                height: 28px;
                text-align: center;
            }
            .customOption {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-bottom: 12px;
            }
            .customSpan {
                min-width: 120px;
                margin: 2px;
            }
            .customOptionDiv {
                padding: 20px;
                overflow-x: auto;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                background-color: #f9fafb;
            }
            .icon.remove-icon {
                cursor: pointer;
                font-size: 20px;
                color: #ef4444;
            }
        </style>
    @endpush

    <div class="content" id="app" v-cloak>
        <form method="POST" 
              action="{{ route('sizechart.admin.index.update', $sizeChart->id) }}" 
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.history.back()"></i>
                        {{ __('sizechart::app.sizechart.template.edit-temp-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('sizechart::app.sizechart.template.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <input type="hidden" name="template_type" 
                       value="{{ $sizeChart->template_type == 'simple' ? 'simple' : 'configurable' }}" />
                <input type="hidden" name="template_id" value="{{ $sizeChart->id }}" />

                <x-admin::accordion>
                    <x-slot:header>
                        {{ __('sizechart::app.sizechart.template.edit-template') }}
                    </x-slot:header>

                    <x-slot:content>
                        <!-- Template Name -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                {{ __('sizechart::app.sizechart.template.template-name') }}
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                name="template_name"
                                value="{{ old('template_name', $sizeChart->template_name) }}"
                                rules="required" />
                            <x-admin::form.control-group.error control-name="template_name" />
                        </x-admin::form.control-group>

                        <!-- Template Code -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                {{ __('sizechart::app.sizechart.template.template-code') }}
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                name="template_code"
                                value="{{ $sizeChart->template_code }}"
                                :disabled="true" />
                        </x-admin::form.control-group>

                        <!-- Custom Options Component -->
                        <div id="custom-options-container">
                            <add-custom-options></add-custom-options>
                        </div>

                        <!-- Image Upload -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label>
                                {{ __('sizechart::app.sizechart.template.template-image') }}
                            </x-admin::form.control-group.label>

                            <x-admin::media.images
                                name="images"
                                :allow-multiple="false"
                                :uploaded-images="$sizeChart->image_path ? [['url' => Storage::url($sizeChart->image_path)]] : []"
                            />
                        </x-admin::form.control-group>
                    </x-slot:content>
                </x-admin::accordion>
            </div>
        </form>
    </div>
</x-admin::layouts>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@2.2.15/dist/vee-validate.min.js"></script>
    
    <script type="text/x-template" id="add-custom-options-template">
        <div>
            <div v-if="!showCustomOptions">
                <div class="control-group" :class="{'has-error': errors.has('config_option')}">
                    <label class="required">Configuration Options</label>
                    <input type="text" 
                           v-model="customOptionValues" 
                           class="control" 
                           placeholder="Enter options separated by commas"
                           v-validate="'required'"
                           name="config_option">
                    <span class="control-error" v-if="errors.has('config_option')">
                        @{{ errors.first('config_option') }}
                    </span>
                    <button type="button" class="btn btn-primary" @click="addCustomOption">
                        Continue
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="customOptionDiv">
                    <div v-for="(row, key) in addRows" :key="key" class="customOption">
                        <span class="customSpan">
                            <input type="text" 
                                   class="custom_input_t" 
                                   v-validate="'required'"
                                   :name="'formname['+ row.row +'][name]'"/>
                        </span>
                        <span v-for="(inputOption, index) in inputOptions" class="customSpan">
                            <input type="text" 
                                   class="custom_input_t" 
                                   v-validate="'required'"
                                   :name="'formname['+ row.row +']['+ inputOption +']'"/>
                        </span>
                        <span>
                            <i class="icon remove-icon" @click="removeCustomRow(key)"></i>
                        </span>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" @click="addCustomRow">
                    Add Row
                </button>
            </div>
        </div>
    </script>

    <script>
        Vue.component('add-custom-options', {
            template: '#add-custom-options-template',
            data: function() {
                return {
                    label: @json($label ?? ''),
                    customOptionValues: @json($customOptions ?? ''),
                    showCustomOptions: false,
                    inputOptions: [],
                    counter: @json(count($addRows ?? [])),
                    configAttribute: '',
                    attribute: '',
                    addRows: @json($addRows ?? [])
                }
            },
            created() {
                if (this.customOptionValues) {
                    this.inputOptions = this.customOptionValues.split(',');
                    this.showCustomOptions = true;
                }
            },
            methods: {
                addCustomOption() {
                    if (this.customOptionValues) {
                        this.inputOptions = this.customOptionValues.split(',').map(item => item.trim());
                        this.showCustomOptions = true;
                    }
                },
                backtoinput() {
                    this.showCustomOptions = false;
                },
                addCustomRow() {
                    this.counter++;
                    this.addRows.push({row: this.counter});
                },
                removeCustomRow(index) {
                    this.addRows.splice(index, 1);
                }
            }
        });

        // Initialize Vue
        document.addEventListener('DOMContentLoaded', function() {
            new Vue({
                el: '#app'
            });
        });
    </script>
@endpush