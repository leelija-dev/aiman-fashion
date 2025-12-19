@if ($sizeChart->template_type == 'simple')    
<div class="control-group" :class="[errors.has('config_option') ? 'has-error' : '']" v-if="!showCustomOptions">
    <label for="config_option" class="required">{{ __('sizechart::app.sizechart.template.config-option') }}</label>
    <input type="text" v-model="customOptionValues" v-validate="{ required: true }" 
           class="control" id="config_option" name="config_option" 
           value="{{ old('config_option') }}" 
           data-vv-as="&quot;{{ __('sizechart::app.sizechart.template.config-option') }}&quot;"/>
    <span class="control-error" v-if="errors.has('config_option')">@{{ errors.first('config_option') }}</span>
    <span class="control-info mt-10">{{ __('sizechart::app.sizechart.template.config-option-info') }}</span>
    <br>
    <button type="button" class="btn btn-lg btn-primary" @click="addCustomOption">
        {{ __('sizechart::app.sizechart.template.continue') }}
    </button>
</div>
@else
<div class="control-group" :class="[errors.has('config_option') ? 'has-error' : '']" v-if="!showCustomOptions">
    <label for="config_option" class="required">{{ __('sizechart::app.sizechart.template.config-option') }}</label>
    <select v-validate="'required'" v-model="attribute" class="control" id="select_attribute" 
            @change="selectAttribute($event)" name="select_attribute" 
            data-vv-as="&quot;{{ __('sizechart::app.sizechart.template.select-attribute') }}&quot;">
        <option value="">{{ __('sizechart::app.sizechart.template.select-attribute') }}</option>
        @foreach ($attributes as $attribute)
            @if ($attribute->name != 'Price')
                <option value="{{ $attribute->id }}">
                    {{ $attribute->name ?: $attribute->admin_name }}
                </option>
            @endif
        @endforeach
    </select>
    <span class="control-error" v-if="errors.has('config_option')">@{{ errors.first('config_option') }}</span>
</div>
<input type="hidden" v-model="configAttribute" name="config_attribute" value="0"/>
@endif