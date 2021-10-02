<div class="">
    <div class="max-w-6xl py-2 mx-auto sm:px-6 lg:px-8">

    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    @this.on('showStatusMsg', (msg, color) => {
        show_banner(msg, color);
    });
});

let group_exist_warning_confirmed = 0;
        function createGroup() {
            //console.log("Create!");
            @this.emit('createGroup');
        }

        function update_group() {
            //console.log("Create/Update!");
            let checked_roles = [];
            let group_assigned_roles = {};
            let group_assigned_role_ids = [];
            let assigned_checked = []; //false;

            document.querySelectorAll('.rolesList').forEach(function(elem) {
                if(elem.checked) {
                    checked_roles.push(elem.value);
                }
                if(elem.getAttribute("data-belongstogroup") == 1) {
                    group_assigned_role_ids.push(elem.value);
                    group_assigned_roles[elem.value] = elem.getAttribute("data-rolename");
                }
            });

            //document.getElementById("role_list_error").innerHTML = "";
            //console.log("Checked Roles: " + checked_roles);
            //console.log("Group Assigned Roles: " + group_assigned_roles);
            //console.log("Assigned Role Ids: " + group_assigned_role_ids);

            //assigned_checked = checked_roles.some(r=> group_assigned_role_ids.indexOf(r) >= 0)
            checked_roles.forEach(function(elem, index) {
                //console.log(index + ' > ' + elem + ' > ' + group_assigned_role_ids.indexOf(elem));
                if(group_assigned_role_ids.indexOf(elem) >= 0) {
                    assigned_checked.push(group_assigned_roles[elem])
                }
            });

            //console.log("Checked Assigned Role(s): " + assigned_checked);
            //console.log("Length: " + checked_roles.length + ' > ' + Object.keys(group_assigned_roles).length + ' > ' + assigned_checked.length);

            if(checked_roles.length > 0 && Object.keys(group_assigned_roles).length > 0 && assigned_checked.length > 0) {
                //console.log("group_exist_warning_confirmed: " + group_exist_warning_confirmed);
                let confirm_msg = "The following roles are already part of other group..<br><br>" + "[ " + assigned_checked + " ]<br><br> Please select OK if you wish to proceed and Save again";

                document.getElementById('xdata_group_div').__x.$data.msg_popup_open = true;
                document.getElementById('msg_popup_content').innerHTML = confirm_msg;

                if(group_exist_warning_confirmed == 1) {
                    group_exist_warning_confirmed = 0;
                    document.getElementById('xdata_group_div').__x.$data.msg_popup_open = false;
                    @this.emit('updateGroup', checked_roles);
                }
            }
            else {
                @this.emit('updateGroup', checked_roles);
            }
        }

        function deleteGroup(id) {
            if(confirm('Are you sure?')) {
                //console.log("DELETE: " + id);
                @this.emit('deleteGroup', id);
            }
        }
</script>
