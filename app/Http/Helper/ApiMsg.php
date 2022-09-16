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
        'notfound_account' => 'انت غير مسجل في النظام',
        'password_faild' => 'كلمة المرور خاطئة',
        'send_code' => 'تم ارسال الرمز بنجاح',
        'expire_code' => 'انتهت صلاحية الرمز',
        'data_null' => 'لايوجد بيانات',
        'default_data' => 'هذه البيانات الافتراضية',
        'success_get' => 'تم جلب البيانات بنجاح',
        'success_subs' => 'تم الاشتراك بنجاح' ,
        'already_added' => 'مضاف فعلا' ,
        'success_add' => 'تم الاضافة بنجاح',
        'success_send' => 'تم الارسال بنجاح',
        'block_account' => 'هذا الحساب تم حظره',
        'not_result' => 'لايوجد نتائج ',
        'error_payment' => 'حدث خطأ اثناء الدفع',
        'error_payment_faild' => 'فشلت عملية الدفع',
        'success_payment' => 'تمت عملية الدفع بنجاح',
        'subs_expire' => 'لقد انتهى الاشتراك وتم تحويلك للخطة المجانية',
        'error_owner' => 'هذا الطفل غير تابع لك',
        'promotion_success' => 'تم تقديم الطلب بنجاح بانتظار موافقة المالك ' ,
        'max_class' => 'لقد وصلت لعدد الصفوف المحدد لك في الخطة',
        'max_children' => ' لقد تجاوزت العدد الاقصى من الطلاب ',
        'unauthorization' => 'ليس لك صلاحية'
        


        








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
        'default_data' => "This data is default",
        'success_get' => 'Get Data Is successfully',
        'success_subs' => 'Subscribed successfully' ,
        'already_added' => 'already added' ,
        'success_add' => 'Add is successfully',
        'success_send' => 'Send successfully',
        'block_account' => 'This account is block',
        'not_result' => ' No Ant Results ',
        'error_payment' => 'An error occurred during payment',
        'error_payment_faild' => 'Payment failed',
        'success_payment' => 'Payment completed successfully',
        'subs_expire' => 'Your Subscribtion is expred , transferred to the free plan ',
        'error_owner' => 'This child does not belong to you',
        'promotion_success' => 'The application has been submitted successfully and is awaiting owner approval',
        'max_class' => 'You have reached the number of rows specified in the plan',
        'max_children' => 'You have exceeded the maximum number of students',
        'unauthorization' => 'Unauthorization'


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
