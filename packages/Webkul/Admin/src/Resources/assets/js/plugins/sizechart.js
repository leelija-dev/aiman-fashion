export default function (app) {
    // Register only if the template is available in DOM
    const tpl = document.getElementById('add-custom-options-template');
    if (!tpl) return;

    // Avoid duplicate registration
    if (app._context.components && app._context.components['add-custom-options']) {
        return;
    }

    app.component('add-custom-options', {
        template: '#add-custom-options-template',

        data() {
            return {
                customOptionValues: '',
                showCustomOptions: false,
                inputOptions: '',
                counter: 0,
                addRows: [],
                // Configurable-specific
                configAttribute: '',
                attribute: '',
            };
        },

        methods: {
            addCustomOption() {
                if (this.customOptionValues !== '' && this.customOptionValues !== null) {
                    this.showCustomOptions = true;
                    this.inputOptions = this.customOptionValues.split(',');
                    if (this.addRows.length === 0) {
                        this.counter = 1;
                        this.addRows.push({ row: 1 });
                    }
                } else {
                    window.flashMessages = [{
                        type: 'alert-error',
                        message: 'Add custom options field cannot be empty',
                    }];
                    if (this.$root && this.$root.addFlashMessages) {
                        this.$root.addFlashMessages();
                    }
                }
            },

            backtoinput() {
                this.showCustomOptions = false;
                this.counter = 0;
                this.addRows = [];
            },

            addCustomRow() {
                this.counter += 1;
                this.addRows.push({ row: this.counter });
            },

            removeCustomRow(key) {
                this.addRows.splice(key, 1);
            },

            // Configurable-only helper (safe to exist for simple)
            selectAttribute(event) {
                this.configAttribute = event.target.value;
                if (!this.$http) return;

                this.$http
                    .get((window.__sizechartAttributeUrl || '/admin/sizechart/attribute') + '?attribute-id=' + event.target.value)
                    .then((response) => {
                        if (response.data && response.data.status) {
                            this.customOptionValues = response.data.customOptionValues;
                            this.addCustomOption();
                        } else {
                            window.flashMessages = [{
                                type: 'alert-error',
                                message: (window.__sizechartNoOptionMsg || 'Custom options not available'),
                            }];
                            if (this.$root && this.$root.addFlashMessages) {
                                this.$root.addFlashMessages();
                            }
                        }
                    })
                    .catch(() => {
                        window.flashMessages = [{
                            type: 'alert-error',
                            message: (window.__sizechartSomethingWrong || 'Something went wrong'),
                        }];
                        if (this.$root && this.$root.addFlashMessages) {
                            this.$root.addFlashMessages();
                        }
                    });
            },
        },
    });
}
