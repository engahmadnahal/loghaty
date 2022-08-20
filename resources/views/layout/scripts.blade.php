
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/tether.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/select/form-select2.js')}}"></script>

    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/datatables/datatable.js')}}"></script>




    <script>
        let date = new Date();
        document.getElementById('copyYear').innerHTML = ""+date.getFullYear();


        
        // For Store Data 
        function performStoreWithTostar(route,dataObj,idForm){
            axios.post(route,dataObj).then(function(response){
                toastr.success(response.data.message,response.data.title, { "progressBar": true });
                if(idForm != undefined){
                    document.getElementById(idForm).reset();
                }
            }).catch(function(error){
                toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
            });
        }

        // For update Data
        function performUpdateWithTostar(route,dataObj){
            axios.post(route,dataObj).then(function(response){
                toastr.success(response.data.message,response.data.title, { "progressBar": true });
            }).catch(function(error){
               
                toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
            });
        }

        // For Delete Data
        function performDeleteWithTostar(route,dataObj,el,closest){
            axios.post(route,dataObj).then(function(response){
                toastr.success(response.data.message,response.data.title, { "progressBar": true });
                el.closest(closest).remove();
            }).catch(function(error){
               
                toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
            });
        }

        // For Store Data without alert
        function performStoreWithOutTostar(route,dataObj,actionSuccess,actionError){
            axios.post(route,dataObj).then(function(response){
                actionSuccess();
            }).catch(function(error){
                actionError();
            });
        }


        
        function performSetLocale(lang){
            let error = ()=> {
                console.log('error');
            }
            let success = ()=> {
                window.location.reload();
            }
            performStoreWithOutTostar('/set-local',{keylang : lang},success,error);

        }
    </script>

   