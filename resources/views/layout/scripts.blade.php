
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
    <script src="{{asset('app-assets/vendors/js/charts/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>





    <script>
        /// ---- For Char Anlytics
        var $dark_green = '#4ea397';
        var $green = '#22c3aa';
        var $light_green = '#7bd9a5';
        var $lighten_green = '#a8e7d2';


        let date = new Date();
        document.getElementById('copyYear').innerHTML = ""+date.getFullYear();
        axios.defaults.headers.post['lang'] = '{{App::getLocale()}}';


        
        // For Store Data 
        function performStoreWithTostar(route,dataObj,idForm){
            try{
                sweetLoad();
                axios.post(route,dataObj).then(function(response){
                    toastr.success(response.data.message,response.data.title, { "progressBar": true });
                    if(idForm != undefined){
                        document.getElementById(idForm).reset();
                    }
                    removSweet();
                }).catch(function(error){
                    toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
                    removSweet();
                });
            }catch(error){
                removSweet();
                errorSweet('حدث خطأ اثناء تنفيذ العملية');
            }

        }

        // For update Data
        function performUpdateWithTostar(route,dataObj){
            try{


            
                sweetLoad();
            axios.post(route,dataObj).then(function(response){
                toastr.success(response.data.message,response.data.title, { "progressBar": true });
                removSweet();

            }).catch(function(error){
            removSweet();
               
                toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
            });

        }catch(error){
                removSweet();
                errorSweet('حدث خطأ اثناء تنفيذ العملية');
            }
        }

        // For Delete Data
        function performDeleteWithTostar(route,dataObj,el,closest){
            try{
            sweetLoad();
            axios.post(route,dataObj).then(function(response){
                toastr.success(response.data.message,response.data.title, { "progressBar": true });
                el.closest(closest).remove();
            removSweet();

            }).catch(function(error){
            removSweet();
               
                toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
            });

        }catch(error){
                removSweet();
                errorSweet('حدث خطأ اثناء تنفيذ العملية');
            }
        }

        // For Store Data without alert
        function performStoreWithOutTostar(route,dataObj,actionSuccess,actionError){
            try{
            sweetLoad();
            axios.post(route,dataObj).then(function(response){
                actionSuccess();
            removSweet();

            }).catch(function(error){
                actionError();
            removSweet();

            });
        }catch(error){
                removSweet();
                errorSweet('حدث خطأ اثناء تنفيذ العملية');
            }
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
        function sweetLoad(){
            var timerInterval
                Swal.fire({
                    title: 'Loading...!',
                onBeforeOpen: function () {
                    Swal.showLoading()
                },
                onClose: function () {
                    clearInterval(timerInterval)
                }
                
                }).then(function (result) {
                if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.timer
                ) {
                    console.log('I was closed by the timer')
                }
                })
        }

        function removSweet(){
            let sweet = document.getElementsByClassName('swal2-container');
            document.body.classList.remove('swal2-shown','swal2-height-auto')
            sweet[0].remove();
        }

        function errorSweet(msg){
            Swal.fire({
                title: "حدث خطأ!",
                text: ""+msg,
                type: "error",
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
            });
        }
        
    </script>

   