
<template>
    <!-- <form method="POST" :action="actionRoute" enctype="multipart/form-data" @submit="submitForm">
        <input type="hidden" name="_token" :value="csrfToken" /> -->
        <FormKit 
            type="form" 
            @submit="submitForm"
            :id="this.formId"
            incomplete-message="Please fix your inputs!"
            :actions="false"
            #default="{ value }"
            >
            <div v-for="field in entry" class="form-group" >
                   <FormKit
                        :v-model="field.name"
                        :type="field.inputType"
                        :options="field.options ? field.options : ''"
                        :name="field.name"
                        :label="field.columnName"
                        :minlength="field.minlength ? field.minlength : ''"
                        :maxlength="field.maxlength ? field.maxlength : ''"
                        :placeholder="field.placeholder ? field.placeholder : ''"
                        :value="field.value ? field.value : ''"
                        :validation="field.validation ? field.validation : ''"
                        :validation-messages="field.validationMessages ? field.validationMessages : ''"
                        
                        validation-visibility="live"
                        />
                    
                <span class="validation-msg" v-if="this.validationErrors[field.name]">{{ this.validationErrors[field.name][0] }}</span>
            </div>
        </FormKit>

    <!-- </form> -->
</template>

<script>

    export default {
        props: {
            entry: {
                type: Object,
                /* required: true, */
            },
            actionRoute: {
                type: String,
                /* required: true, */
            },
            csrf: {
                type: String,
            },
            modalId: {
                type: String,
            }
        },
        data() {
            const formId = `${this.modalId}-form`;
            const submitButtonId = `${this.modalId}-submit`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            return {
                formId,
                submitButtonId,
                csrfToken,
                validationErrors: {},
            }
        },
        mounted() {
            const button = document.getElementById(this.submitButtonId); 
            button.addEventListener('click', this.submitForm);
        },
        methods: {
            getInput(field) {
                console.log(field);
            },
            async submitForm(e) {
                // e.preventDefault();
                const form = document.getElementById(this.formId);
                // const form = e.target.closest('.modal-content').querySelector('form');
                // form.submit();
                const formData = new FormData(form);
                
                console.log(formData);
                console.log(this.actionRoute);

                //this.$formkit.submit();
                // if (form.hasInvalidInputs()) { console.log('invalid input'); return; }

                // const requestOptions = {
                //     // method: 'PUT',
                //     'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                //     // headers: { 'Content-Type': 'application/json' },
                // }
                // fetch(this.actionRoute, requestOptions)
                // .then(response => {
                //     // response.json();
                //     console.log(response);
                // });

                // form.submit();
                try {
                    const response = await axios.post(this.actionRoute, formData,
                    {
                        headers: {
                            // 'Content-Type': 'application/x-www-form-urlencoded',
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    console.log(response);
                    // form.submit();
                    window.location.href = response.request.responseURL;
                
                } catch (error) {
                    
                    if (error.response.status === 422) {
                        const errorData = await error.response.data;
                        this.validationErrors = errorData.errors;
                        console.log(this.validationErrors);

                        const modalContent = e.target.closest('.modal-content');
                        const modalElement = e.target.closest('.modal');
                        // Scroll screen to the first field that returned error on submit
                        const validationMessageElement = modalContent.querySelector(`.validation-msg`).closest('input');
                        console.log(validationMessageElement);
                        // Check if the element exists before scrolling
                        // if (validationMessageElement) {
                            // Get the Y position of the element relative to the viewport
                            const yOffset = validationMessageElement.getBoundingClientRect().top;

                            // Scroll the page to the element's position
                            modalElement.scrollTo({
                                top: window.scrollY + yOffset,
                                behavior: 'smooth',
                            });
                        // }
                        
                    }
                    console.log(error.response);
                }


            },
        }
    }
</script>