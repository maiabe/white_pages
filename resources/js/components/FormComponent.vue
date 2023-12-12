
<template>
    <!-- <form method="POST" :action="actionRoute" enctype="multipart/form-data" @submit="submitForm">
        <input type="hidden" name="_token" :value="csrfToken" /> -->
        <FormKit 
            type="form"
            method="POST"
            @submit="submitForm"
            :id="this.formId"
            incomplete-message="Please fix your inputs!"
            #default="{ state: { valid } }"
            :actions="false"
            >
            <FormKit type="hidden" name="_token" :value="this.csrfToken" />
            <div v-for="(formInput, index) in formInputs" :key="index" class="form-group" >
                <FormKit
                        :v-model="formInput.name"
                        :type="formInput.inputType"
                        :options="formInput.options ? formInput.options : ''"
                        :name="formInput.name"
                        :label="formInput.label"
                        :minlength="formInput.minlength ? formInput.minlength : ''"
                        :maxlength="formInput.maxlength ? formInput.maxlength : ''"
                        :placeholder="formInput.placeholder ? formInput.placeholder : ''"
                        :value="formInput.value ? formInput.value : ''"
                        :validation="formInput.validation ? formInput.validation : ''"
                        :validation-messages="formInput.validationMessages ? formInput.validationMessages : ''"
                        validation-visibility="live"
                        />
                    
                <span class="validation-msg" v-if="this.validationErrors[formInput.name]">{{ this.validationErrors[formInput.name][0] }}</span>
            </div>
            <div class="button-wrapper">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-button">
                    Close
                </button>
                <!-- <button type="submit" ref="submitButton" :id="`${modalId}-submit`" class="btn btn-edit submit-button">
                    Confirm
                </button> -->
                <FormKit 
                    type="submit" 
                    label="Confirm"
                    class="btn submit-button"
                    ref="submitButton"
                    :id="`${modalId}-submit`"
                    :disabled="!valid"
                />
            </div>
        </FormKit>

    <!-- </form> -->
</template>

<script>

    export default {
        props: {
            formInputs: {
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
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            return {
                formId,
                csrfToken,
                validationErrors: {},
            }
        },
        mounted() {
            const button = document.getElementById(`${this.modalId}-submit`);
            button.classList.add('btn');
            if (this.modalId.includes('edit')) {
                button.classList.add('btn-edit');
            }
            else if (this.modalId.includes('add')) {
                button.classList.add('btn-add');
            }
            button.addEventListener('click', this.submitForm);

            // Select 
        },
        methods: {
            async submitForm(e) {
                e.preventDefault();
                const form = document.getElementById(this.formId);
                // const form = e.target.closest('.modal-content').querySelector('form');
                // form.submit();
                const formData = new FormData(form);
                
                console.log(formData);
                console.log(this.actionRoute);
                form.action = this.actionRoute;

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
                
                form.submit();
               

                // form.submit();
                // try {
                //     const response = await axios.post(this.actionRoute, formData,
                //     {
                //         headers: {
                //             // 'Content-Type': 'application/x-www-form-urlencoded',
                //             'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                //         }
                //     });
                //     console.log(response);
                //     // form.submit();
                //     window.location.href = response.request.responseURL;
                
                // } catch (error) {
                    
                //     if (error.response.status === 422) {
                //         const errorData = await error.response.data;
                //         this.validationErrors = errorData.errors;
                //         console.log(this.validationErrors);

                //         const modalContent = e.target.closest('.modal-content');
                //         const modalElement = e.target.closest('.modal');
                //         // Scroll screen to the first field that returned error on submit
                //         const validationMessageElement = modalContent.querySelector(`.validation-msg`).closest('input');
                //         console.log(validationMessageElement);
                //         // Check if the element exists before scrolling
                //         // if (validationMessageElement) {
                //             // Get the Y position of the element relative to the viewport
                //             const yOffset = validationMessageElement.getBoundingClientRect().top;

                //             // Scroll the page to the element's position
                //             modalElement.scrollTo({
                //                 top: window.scrollY + yOffset,
                //                 behavior: 'smooth',
                //             });
                //         // }
                        
                //     }
                //     console.log(error.response);
                // }


            },
        }
    }
</script>