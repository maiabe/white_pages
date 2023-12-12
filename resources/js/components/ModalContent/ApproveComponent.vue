<template>
    <form method="POST" @submit.prevent="submitForm" :class="`${this.status}-approval-form`">
        <input type="hidden" name="_token" :value="csrfToken" />
        <div class="approve-message">
            <span>Approve or reject the pending record below: </span>
        </div>
        <div class="approve-info-wrapper">
            <div v-if="this.status == 'update'" class="current-info approve-info">
                <div class="approve-info-title">
                    <span>Original Record: </span>
                </div>
                <div v-for="item in existingInfo" class="approve-info-field">
                    <span v-if="item.key !== null">
                        <b>{{ item.key }}:&nbsp;</b><span>{{ item.options ? item.options[item.value] : item.value }}</span>
                    </span>
                </div>
            </div>
            <div v-if="this.status == 'update'" class="arrow-wrapper">
                <font-awesome-icon icon="fa-right-long" style="color: black" />
            </div>
            <div class="pending-info approve-info">
                <div class="approve-info-title">
                    <span v-if="this.status == 'update'">Update Record To: </span>
                </div>
                <div v-for="item in getPendingInfo(entry)" class="approve-info-field" >
                    <input type="hidden" :name="item.name" :value="item.value" :v-model="item.name" />
                    <span v-if="item.inputType !== 'hidden'" ><b>{{ item.label }}:&nbsp;</b>
                        <span>{{ item.options ? item.options[item.value] : item.value }}</span>
                    </span>
                </div>
            </div>
        </div>

        <div class="button-wrapper">
            <button type="button" ref='rejectButton' class="btn btn-reject" :id="`${modalId}-reject`">
                Reject
            </button>
            <button type="submit" ref="approveButton" :id="`${modalId}-approve`" class="btn btn-approve submit-button">
                Approve
            </button>
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
            const rejectButtonId = `${this.modalId}-reject`;
            const approveButtonId = `${this.modalId}-approve`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            // const dept_info = this.getDepartmentInfo(this.entry);
            const existingInfo = this.getExistingInfo(this.entry);
            const pendingInfo = this.getPendingInfo(this.entry);
            const status = this.entry['status'].value;


            return {
                rejectButtonId,
                approveButtonId,
                csrfToken,
                status,
                existingInfo,
                pendingInfo
            }
        },
        mounted() {
            const rejectBtn = document.getElementById(this.rejectButtonId);
            rejectBtn.addEventListener('click', this.submitForm);
            const approveBtn = document.getElementById(this.approveButtonId);
            approveBtn.addEventListener('click', this.submitForm);

            const modal = document.getElementById(this.modalId);
            modal.classList.add('approve-modal');
            const modalTitle = modal.querySelector('.modal-header .modal-title');
            modalTitle.textContent = `Review ${this.status.toUpperCase()} Action`;

            // Adjust color of the modal header and width of the modal dialog for 'update' approval
            if (this.entry['status'].value == 'update') {
                const modalDialog = modal.querySelector('.modal-dialog');
                modalDialog.style.maxWidth = '50%';
                // Adjust color of modal header for 'update' action
                modalTitle.style.color = 'rgb(112, 167, 209)';
            }
            else if (this.entry['status'].value == 'create') {
                // Adjust color of the modal header for 'create' action
                modalTitle.style.color = 'rgb(106, 187, 90)';
            }
            else {
                // Adjust color of the modal header for 'delete' action
                modalTitle.style.color = 'rgba(203, 93, 93)';
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
                const existing_info = entry.existing_info;
                const result = [];
                if(existing_info && existing_info.value){
                    const infoVal = existing_info.value;
                    const keys = Object.keys(infoVal);
                    keys.forEach(k => {
                        result.push({key: k, value: infoVal[k]});
                    });
                }
                return result;
            },
            async submitForm(e) {
                e.preventDefault();

                // Check if the button pressed was for reject or approve
                let actionType = e.target.getAttribute('id');
                console.log(actionType);
                if (actionType.includes('reject')) {
                    actionType = 'reject';
                }
                else {
                    actionType = 'approve';
                }

                console.log(actionType);


                const form = e.target.closest('.modal-content').querySelector('form');
                // form.submit();
                const formData = new FormData(form);
                
                console.log(formData);

                let actionURL = this.actionRoute;
                if (actionType == 'reject') {
                    actionURL = actionURL.replace('approve', 'reject');
                }

                console.log(actionURL);

                form.action = actionURL;

                form.submit();
                // try {
                //     const response = await axios.post(actionURL, formData,
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
            }
        }
    }
</script>