<template>
    <form method="POST" :action="actionRoute" @submit.prevent="submitForm">
        <!-- <input type="hidden" name="_token" :value="csrfToken" /> -->
        <div class="approve-message">
            Approve or Reject the pending change below:
        </div>
        <div class="approve-message-fields">
            <p v-for="item in getFieldsToDisplay(entry)" >
                <input v-if="item.inputType == 'hidden'" :type="item.inputType" :name="item.name" :value="item.value" :v-model="item.name" />
                <span v-else><b>{{ item.label }}: </b><span>{{ item.value }}</span></span>
            </p>
        </div>
    </form>
    
</template>

<script>
    export default {
        name: 'ApproveComponent',
        props: {
            datasetType: {
                type: String,
            },
            idFieldName: {
                type: String
            },
            entry: {
                type: Object
            },
            actionRoute: {
                type: String
            },
            csrf: {
                type: String,
            },
            modalId: {
                type: String
            }
        },
        data() {
            const submitButtonId = `${this.modalId}-submit`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            return {
                submitButtonId,
                csrfToken
            }
        },
        mounted() {
            const submitBtn = document.getElementById(this.submitButtonId);
            submitBtn.classList.add('approve-button');
            submitBtn.addEventListener('click', this.submitForm);
        },
        methods: {
            getFieldsToDisplay(entry) {
                const fields = [];
                Object.keys(entry).forEach(key => {
                    if (typeof(entry[key]) == 'object') {
                        fields.push(entry[key].formInput);
                    }
                });
                return fields;
            },
            submitForm(e) {
                e.preventDefault();
                const form = e.target.closest('.modal-content').querySelector('form');
                console.log(form);
                const formData = new FormData(form);
                console.log(formData);

                // const id_key = Object.keys(this.entry).filter(key => key == this.idField.key);
                // console.log(this.idFieldName);
                // if (this.idField > 0) {
                //     const targetId = this.entry[id_key].value;
                //     console.log(targetId);
                //     console.log(this.actionRoute);
                
                form.submit();
                    
                // axios.post(this.actionRoute, formData)
                // .then(response => {
                //     // Handle the response
                //     console.log(response.data);
                // })
                // .catch(error => {
                //     // Handle errors
                // });
                    
            },
        }
    }
</script>