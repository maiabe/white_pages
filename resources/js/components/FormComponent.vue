
<template>
    <form method="POST" :action="actionRoute" enctype="multipart/form-data">
        <input type="hidden" name="_token" :value="csrfToken" />
        <div v-for="field in entry" class="form-group" >
            <label v-if="field.inputType!=='hidden'" :for="field.name">{{ field.columnName }}</label>
            <input v-if="field.inputType!=='select'"
                    :v-model="entry[field.key]"
                    :name="field.name"
                    :type="field.inputType"
                    :value="field.value"
                    class="form-control"
            />
            <select v-if="field.inputType=='select'"
                    :v-model="entry[field.key]"
                    class="form-select"
                    :name="field.name" >
                <option v-for="option in field.options" :selected="field.value === option">{{ option }}</option>
            </select>
            <span class="validation-msg" v-if="this.validationErrors[field.name]">{{ this.validationErrors[field.name][0] }}</span>
        </div>
    </form>
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
            submitButtonId: {
                type: String,
            }
        },
        /* data() {
            const formData = {};
            const fieldTypes = {};

            console.log(this.entry);
            for (const key of Object.keys(this.entry)) {
                const fieldName = this.entry[key].name;
                const fieldType = this.entry[key].type;
                formData[fieldName] = this.entry[key].value;
                fieldTypes[fieldName] = fieldType;
            }
            console.log(formData);
            return {
                model: this.entry,
            };
        }, */
        data() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            return {
                csrfToken,
                validationErrors: {},
            }
        },
        mounted() {
            const button = document.getElementById(this.submitButtonId); 
            button.addEventListener('click', this.submitForm);
        },
        methods: {
            async submitForm(e) {
                e.preventDefault();
                const form = e.target.closest('.modal-content').querySelector('form');
                // form.submit();
                const formData = new FormData(form);
                
                console.log(formData);
                console.log(this.actionRoute);
                try {
                    const response = await axios.post(this.actionRoute, formData,
                    {
                        // headers: {
                        //     'Content-Type': 'application/x-www-form-urlencoded',
                        //     'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                        // }
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
                        const validationMessageElement = modalContent.querySelector(`input[name='dept-name']`);
                        console.log(validationMessageElement);
                        // Check if the element exists before scrolling
                        if (validationMessageElement) {
                            // Get the Y position of the element relative to the viewport
                            const yOffset = validationMessageElement.getBoundingClientRect().top;

                            // Scroll the page to the element's position
                            modalElement.scrollTo({
                                top: window.scrollY + yOffset,
                                behavior: 'smooth',
                            });
                        }

                    }
                    console.log(error.response);

                    // Restore values on currently working form
                    const formData = error.response.config.data;
                    // const entries = formData.entries;
                    const inputFields = form.querySelectorAll('input');
                    inputFields.forEach(input => {
                        console.log(input);
                        const value = formData[input.name];
                        input.value = value;
                    });
                }

            },
        }
    }
</script>