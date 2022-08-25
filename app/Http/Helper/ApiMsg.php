<?php 

namespace App\Http\Helper;

use Illuminate\Http\Request;

class ApiMsg {

    private static $ar = [
        'success'=>'تم بنجاح',
        'error'=>'حدث خطأ ما',
        'success_create'=>'تم الانشاء بنجاح',
        'error_create'=>'حدث خطأ أثناء الانشاء',
        'success_edit'=>'تم التحديث بنجاح',
        'error_edit'=>'حدث خطأ أثناء التحديث',
        'success_delete' => 'تم الحذف بنجاح',
        'error_delete' => 'حدث خطأ اثناء الحذف',
        'success_action' =>'تم العملية بنجاح',
        'error_action' =>'حدث خطأ اثناء تنفيذ العملية',
        'points_grth_total_level'=>'لقد تجاوزت عدد النقاط في هذا المستوى',
        'succes_get' => 'تم الجلب بنجاح',
        'error_get' => 'خطأ في عملية الجلب ',
        'num_subs_grt_plan' => 'عدد الاشتراكات تجاوز الحد لهذه الخطة'  ,
        'giv_permission' => 'تم اعطاء الصلاحية للمستخدم',
        'success_login' => 'تم التسجيل بنجاح',
        'notfound_account' => 'انت غير مسجل في الظام',
        'password_faild' => 'كلمة المرور خاطئة',
        'send_code' => 'تم ارسال الرمز بنجاح',
        'expire_code' => 'انتهت صلاحية الرمز',
        'data_null' => 'لايوجد بيانات',
        'default_data' => 'هذه البيانات الافتراضية'




    ];

    private static $en = [
        'success'=>'Success',
        'error'=>'Something went wrong',
        'success_create'=>'Created Successfully',
        'error_create'=>' An error occurred during creation'  ,
        'success_edit'=>'Updated successfully' ,
        'error_edit'=>'An error occurred while updating',
        'success_delete' => 'Deleted successfully',
        'error_delete' => 'An error occurred while deleting' ,
        'success_action' =>'Operation completed successfully',
        'error_action' =>'An error occurred while executing the operation',
        'points_grth_total_level'=>'You have exceeded the number of points at this level',
        'succes_get' => 'successfully fetched',
        'error_get' => 'Fetching error',
        'num_subs_grt_plan' => 'The number of subscriptions exceeded the limit for this plan'  ,
        'giv_permission' => 'The user has been given permission',
        'success_login' => 'Login is successfully',
        'notfound_account' => 'You are not registered in the system',
        'password_faild' => 'wrong password',
        'send_code' => 'Send Code is successfully',
        'expire_code' => 'Expire This code',
        'data_null' => 'Data is not Found',
        'default_data' => "This data is default"

    ];


    public static function getMsg(Request $request, $msg){
        $lang = $request->header('lang') ?? 'ar';
        if($lang == 'ar'){
            return ApiMsg::$ar[$msg];
        }else{
            return ApiMsg::$en[$msg];
        }
    }

}
