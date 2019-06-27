<?php 
namespace App\Repositories;
use App\User;
use App\Models\Admin;
use App\Notifications\NoticeNotification;
use Carbon\Carbon;

class ZcjyNoticeRepository{
  
/**
 * [管理员 操作消息模板]
 * @param  [type] $action  [动作]
 * @param  [type] $content [描述]
 * @return [string]          [description]
 */
public function notice_template($action,$content){

    return admin()->type.tag(admin()->nickname).tag($action).'了'.$content;
    
}

/**
 * [群发通知 默认发给超级管理员]
 * @param  [type] $group   [description]
 * @param  [type] $content [description]
 * @param  string $type    [description]
 * @return [type]          [description]
 */
public function sendGroupNotice($content,$group = null,$type = '系统消息'){
    $group = empty($group) ? Admin::all() : $group;

    if(!empty($group) && count($group)){
        foreach ($group as $k => $auth) {
            $auth->notify(new NoticeNotification(['content' => $content,'type' => $type]));
        }
    }
    else{
        return '错误,没有该用户';
    }

}

/**
 * [发送通知]
 * @param  [type]  $auth_id [description]
 * @param  [type]  $content [description]
 * @param  boolean $admin   [description]
 * @param  string  $type    [description]
 * @return [type]           [description]
 */
public function sendNotice($auth_id,$content,$admin = false,$type = '系统消息'){
    $auth = $admin 
    ? Admin::find($auth_id)
    : User::find($auth_id);
    // Log::info('auth');
    // Log::info($auth);
    if(!empty($auth)){
      $auth->notify(new NoticeNotification(['content' => $content,'type' => $type]));
    }
     else{
    	return '错误,没有该用户';
    }
}

/**
 * [所有/没有读取的通知]
 * @param  [int] $auth_id   [description]
 * @param  [bool] $un_readed [默认不传 取出所有的通知,传true的话取出所有未读通知]
 * @return [type]            [description]
 */
public function allNotices($auth_id,$un_readed=false,$admin = false){
     $auth = $admin 
    ? Admin::find($auth_id)
    : User::find($auth_id);
    if(!empty($auth)){
        $message= $un_readed 
        ? $auth->unreadNotifications 
        : $auth->notifications;
        foreach ($message as $k => $v) {
           $v['currentTime'] = $v->created_at->diffForHumans();
        }
        return $message;
    }
     else{
    	return '错误,没有该用户';
    }
}

/**
 * [批量标记通知为已读]
 * @param  [int] $auth_id [description]
 * @param  [bool] $all     [默认不传批量标记所有未读信息,传notice id更新单个s信息]
 * @return [type]          [description]
 */
public function readedNotice($auth_id,$all=true,$admin = false){
    $auth = $admin 
    ? Admin::find($auth_id)
    : User::find($auth_id);
    if(!empty($auth)){
       return $all === true
        ? $auth->unreadNotifications->markAsRead()
        : !empty($auth->unreadNotifications->where('id',$all)->first()) ? $auth->unreadNotifications->where('id',$all)->first()->markAsRead() : '错误,没有该通知';
    }
    else{
    	return '错误,没有该用户';
    }
}

/**
 * [更新单条消息的内容]
 * @param  [type]  $auth_id   [description]
 * @param  [type]  $notice_id [description]
 * @param  boolean $admin     [description]
 * @param  [type]  $attr      [description]
 * @return [type]             [description]
 */
public function updateNotice($auth_id , $notice_id , $admin = false , $attr){
    $auth = $admin 
    ? Admin::find($auth_id)
    : User::find($auth_id);
    if(!empty($auth)){
      $notice = $auth->notifications->where('id',$notice_id)->first();
      if(!empty($notice)){
         $notice->update($attr);
      }
      else{
        return '没有该消息';
      }
    }
    else{
        return '错误,没有该用户';
    }
}


/**
 * [删除消息]
 * @param  [type]  $auth_id   [description]
 * @param  boolean $admin     [description]
 * @param  [type]  $notice_id [description]
 * @return [type]             [description]
 */
public function deleteNotice($auth_id ,$notice_id,$admin = false){
  $auth = $admin 
    ? Admin::find($auth_id)
    : User::find($auth_id);
    if(!empty($auth)){
      $notice = $auth->notifications->where('id',$notice_id)->first();
      !empty($notice)
      ? $notice->delete() 
      : '没有该消息';
    }
    else{
        return '错误,没有该用户';
    }
}


}