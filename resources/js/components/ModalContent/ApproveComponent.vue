<template>
    <form method="POST" :action="actionRoute" @submit.prevent="submitForm" :class="`${this.status}-approval-form`">
        <!-- <input type="hidden" name="_token" :value="csrfToken" /> -->
        <div class="approve-message">
            <span>Approve {{ this.status }} action of the record below: </span>
        </div>
        <div class="approve-info-wrapper">
            <div v-if="existingInfo.length > 0" class="current-info approve-info">
                <div class="approve-info-title">
                    <span>Original Record: </span>
                </div>
                <div v-for="item in existingInfo">
                    <span v-if="item.key !== null">
                        <b>{{ item.key }}:&nbsp;</b><span>{{ item.value }}</span>
                    </span>
                </div>
            </div>
            <div class="pending-info approve-info">
                <div class="approve-info-title">
                    <span v-if="this.status == 'update'">Update Record To: </span>
                </div>
                <div v-for="item in getPendingInfo(entry)" class="" >
                    <input v-if="item.inputType == 'hidden'" :type="item.inputType" :name="item.name" :value="item.value" :v-model="item.name" />
                    <span v-else><b>{{ item.label }}:&nbsp;</b><span>{{ item.value }}</span></span>
                </div>
            </div>
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
            // const dept_info = this.getDepartmentInfo(this.entry);
            const existingInfo = this.getExistingInfo(this.entry);
            const pendingInfo = this.getPendingInfo(this.entry);
            const status = this.entry['status'].value;

            return {
                submitButtonId,
                csrfToken,
                status,
                existingInfo,
                pendingInfo
            }
        },
        mounted() {
            const submitBtn = document.getElementById(this.submitButtonId);
            submitBtn.classList.add('approve-button');
            submitBtn.addEventListener('click', this.submitForm);

            // Adjust color of the modal header and width of the modal dialog for 'update' approval
            if (this.entry['status'].value == 'update') {
                const modal = document.getElementById(this.modalId);
                const modalDialog = modal.querySelector('.modal-dialog');
                modalDialog.style.maxWidth = '40%';
                const modalHeader = modal.querySelector('.modal-header');
                modalHeader.style.backgroundColor = 'rgb(106,187,90)';
                modalHeader.style.color = 'white';
                modalHeader.style.boxShadow = '1px 1px 3px rgba(21, 21, 21, 0.3)';
            }
            // Adjust color of the modal header for 'create' approval
            else if (this.entry['status'].value == 'create') {
                const modalHeader = document.getElementById(this.modalId).querySelector('.modal-header');
                modalHeader.style.backgroundColor = 'rgb(106,187,90)';
                modalHeader.style.color = 'white';
                modalHeader.style.boxShadow = '1px 1px 3px rgba(21, 21, 21, 0.3)';
            }
            // Adjust color of the modal header for 'delete' approval
            else {
                const modalHeader = document.getElementById(this.modalId).querySelector('.modal-header');
                modalHeader.style.backgroundColor = 'rgba(203, 93, 93)';
                modalHeader.style.color = 'white';
                modalHeader.style.boxShadow = '1px 1px 3px rgba(21, 21, 21, 0.3)';
            }


        },
        methods: {
            getPendingInfo(entry) {
                const fields = [];
                Object.keys(entry).forEach(key => {
                    if (typeof(entry[key]) == 'object') {
                        if (entry[key].formInput) {
                            // Gets the current pending department info
                            fields.push(entry[key].formInput);
                        }
                    }
                });
                return fields;
            },
            getExistingInfo(entry) {
                const dept_info = entry.dept_info;
                const result = [];
                if(dept_info.value){
                    const deptInfoVal = dept_info.value;
                    console.log(deptInfoVal);
                    const keys = Object.keys(deptInfoVal);
                    keys.forEach(k => {
                        // console.log(deptInfoVal[k]);
                        result.push({key: k, value: deptInfoVal[k]});
                    });
                }
                // }
                // if (dept_info.value) {
                //     let fields = dept_info.value;
                //     Object.keys(fields).forEach(key => {
                //         if (key !== 'id') {
                //             console.log({key: fields[key]});
                //         }
                //     });
                // }
                return result;
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