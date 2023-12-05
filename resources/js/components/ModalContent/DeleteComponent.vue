<template>
    <form method="POST" :action="actionRoute" @submit.prevent="submitForm">
        <input type="hidden" name="_token" :value="csrfToken" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <input type="hidden" :name="this.idField.name" :value="this.idField.value" :v-model="this.entry[this.idFieldName]" />
        <div class="delete-message">
            Deleting this will completely remove the record from the database.
        </div>
        <div class="delete-message-fields">
            <p v-for="item in this.displayedFields" >
                <b>{{ item.columnName }}: </b><span>{{ item.value }}</span>
            </p>
        </div>
        <div>
            Are you sure you want to delete this {{ datasetType }}?
        </div>
    </form>
    
</template>

<script>
    export default {
        name: 'DeleteComponent',
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
            const displayedFields = {};
            let idField = '';
            Object.keys(this.entry).forEach(key => {
                if (this.entry[key].inputType !== 'hidden') {
                    displayedFields[key] = this.entry[key];
                }
                else {
                    // Name of the id field
                    idField = this.entry[key];
                }
            });
            return {
                submitButtonId,
                displayedFields,
                idField,
                csrfToken
            }
        },
        mounted() {
            const submitBtn = document.getElementById(this.submitButtonId);
            submitBtn.classList.add('delete-button');
            submitBtn.addEventListener('click', this.submitForm);
        },
        methods: {
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