<?php

class Samplefeedback extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Createuserlisting the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{sample_listing_feedbacks}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_default_sample_listing_id', 'required'),
            array('user_default_sample_listing_feedback_id,user_default_sample_listing_id,user_default_profiles_id,user_default_feedback_likes_total,user_default_feedback_dislikes_total', 'numerical', 'integerOnly'=>true),
            array('user_default_sample_listing_feedback_message', 'length', 'max'=>21845),
            array('user_default_sample_listing_feedback_id,user_default_sample_listing_id, user_default_profiles_id, user_default_sample_listing_feedback_message, user_default_sample_listing_feedback_rating,user_default_feedback_likes_total, user_default_feedback_dislikes_total,user_default_first_feedback, user_default_parent_id, user_default_sample_listing_feedback_date', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'user_default_sample_listing_feedback_id' => 'Lid',
            'user_default_sample_listing_id' => ' Lid',
            'user_default_profiles_id' => ' User id',
            'user_default_sample_listing_feedback_message' => ' Message',
            'user_default_sample_listing_feedback_rating' => ' Rating',
            'user_default_feedback_likes_total' => ' likes',
            'user_default_feedback_dislikes_total' => ' dislikes',
            'user_default_first_feedback' => ' first feedback',
            'user_default_parent_id' => ' Parent',
            'user_default_sample_listing_feedback_date' => ' date',

        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria= new CDbCriteria;

        $criteria->compare('user_default_sample_listing_feedback_id',$this->user_default_sample_listing_feedback_id);
        $criteria->compare('user_default_sample_listing_id',$this->user_default_sample_listing_id,true);
        $criteria->compare('user_default_profiles_id',$this->user_default_profiles_id,true);
        $criteria->compare('user_default_sample_listing_feedback_message',$this->user_default_sample_listing_feedback_message,true);
        $criteria->compare('user_default_sample_listing_feedback_rating',$this->user_default_sample_listing_feedback_rating,true);
        $criteria->compare('user_default_feedback_likes_total',$this->user_default_feedback_likes_total,true);
        $criteria->compare('user_default_feedback_dislikes_total',$this->user_default_feedback_dislikes_total,true);
        $criteria->compare('user_default_first_feedback',$this->user_default_first_feedback,true);
        $criteria->compare('user_default_parent_id',$this->user_default_parent_id,true);
        $criteria->compare('user_default_sample_listing_feedback_date',$this->user_default_sample_listing_feedback_date,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    public static function getFeedbacksByListing($listingId, $offset, $limit, $commentOrderBy, $userReputation, $userProfession){

        // $result = array();

        $CDbCriteria = FALSE;

        if( ($commentOrderBy != "user_default_reputation desc") && ($commentOrderBy != "user_default_reputation asc") && ($userProfession == "0") ){

            $criteria = new CDbCriteria;
            $criteria->select = array('*, (user_default_feedback_likes_total - user_default_feedback_dislikes_total) as rate');
            $criteria->addCondition('user_default_sample_listing_id = '.$listingId);
            $criteria->addCondition("user_default_first_feedback = '1'");
            $criteria->offset = $offset;
            $criteria->limit = $limit;
            $criteria->order = $commentOrderBy;

            $CDbCriteria = TRUE;

        }elseif ( (($commentOrderBy == "user_default_reputation desc") || ($commentOrderBy == "user_default_reputation asc")) && ($userProfession == "0") ) {

            $sql = "SELECT c1.user_default_sample_listing_feedback_id FROM {{sample_listing_feedbacks}} c1";
            $sql .= " INNER JOIN (";
            $sql .= " SELECT u.user_default_id as user_id,(sum(user_default_feedback_likes_total) - sum(user_default_feedback_dislikes_total)) AS user_default_reputation";
            $sql .= " FROM {{sample_listing_feedbacks}} c2";
            $sql .= " INNER JOIN {{profiles}} u";
            $sql .= " ON c2.user_default_profiles_id = u.user_default_id";
            $sql .= " WHERE c2.user_default_sample_listing_id = {$listingId}";
            $sql .= " GROUP BY c2.user_default_profiles_id) z";
            $sql .= " ON z.user_id = c1.user_default_profiles_id";
            $sql .= " WHERE c1.user_default_sample_listing_id = {$listingId}";
            $sql .= " ORDER BY z.{$commentOrderBy}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

        }elseif ( ($commentOrderBy != "user_default_reputation desc") && ($commentOrderBy != "user_default_reputation asc") && ($userProfession != "0") ) {

            $sql = "SELECT c.user_default_sample_listing_feedback_id, (user_default_feedback_likes_total - user_default_feedback_dislikes_total) as rate FROM {{sample_listing_feedbacks}} c";
            $sql .= " INNER JOIN {{profiles}} u";
            $sql .= " ON c.user_default_profiles_id = u.user_default_id";
            $sql .= " INNER JOIN {{profession}} p";
            $sql .= " ON u.user_default_profession = p.profession_id";
            $sql .= " WHERE c.user_default_first_feedback = '1'";
            //$sql .= " AND u1.user_default_sample_listing_id = {$listingId}";
            $sql .= " AND p.profession_id = {$userProfession}";
            $sql .= " ORDER BY {$commentOrderBy}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

        }elseif ( (($commentOrderBy == "user_default_reputation desc") || ($commentOrderBy == "user_default_reputation asc")) && ($userProfession != "0") ) {

            $sql = "SELECT c1.user_default_sample_listing_feedback_id, z.user_default_reputation FROM {{sample_listing_feedbacks}} c1";
            $sql .= " INNER JOIN (";
            $sql .= " SELECT u.user_default_id as user_id, (sum(user_default_feedback_likes_total) - sum(user_default_feedback_dislikes_total)) AS user_default_reputation";
            $sql .= " FROM {{sample_listing_feedbacks}} c2";
            $sql .= " INNER JOIN {{profiles}} u";
            $sql .= " ON c2.user_default_profiles_id = u.user_default_id";
            $sql .= " INNER JOIN {{profession}} p";
            $sql .= " ON u.user_default_profession = p.profession_id";
            $sql .= " WHERE c2.user_default_sample_listing_id = {$listingId}";
            $sql .= " AND p.profession_id = {$userProfession}";
            $sql .= " GROUP BY c2.user_default_profiles_id) z";
            $sql .= " ON z.user_id = c1.user_default_profiles_id";
            $sql .= " WHERE c1.user_default_first_feedback = '1'";
            $sql .= " AND c1.user_default_sample_listing_id = {$listingId}";
            $sql .= " ORDER BY {$commentOrderBy}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

        }


        if( !$CDbCriteria ){

            $commentsCommand = Yii::app()->db->createCommand($sql)->queryAll();

            foreach ($commentsCommand as $commentCommand) {

                $comment = Samplefeedback::model()->findByPk($commentCommand['user_default_sample_listing_feedback_id']);

                $result[$comment->user_default_sample_listing_feedback_id]['comment'] = $comment;

                $postComments = $comment->getPostComments();

                $result[$comment->user_default_sample_listing_feedback_id]['post_comment'] = $postComments;
            }

        }else{

            $comments = Samplefeedback::model()->findAll($criteria);

            foreach ($comments as $comment) {

                $result[$comment->user_default_sample_listing_feedback_id]['comment'] = $comment;

                $postComments = $comment->getPostComments();

                $result[$comment->user_default_sample_listing_feedback_id]['post_comment'] = $postComments;

            }

        }

        return $result;

    }

    public function getPostComments(){

        $sql = "SELECT * ";
        $sql .= "FROM {{sample_listing_feedbacks}}  ";
        //$sql .= "INNER JOIN {{interactions}} c ";
        //$sql .= " ON pc.user_default_interactions_message_id = c.user_default_interaction_id ";
        //$sql .= "INNER JOIN {{user}} u ";
        //$sql .= " ON c.user_id = u.drg_id ";
        $sql .= " WHERE user_default_parent_id = {$this->user_default_sample_listing_feedback_id}";
        $sql .= " ORDER BY user_default_sample_listing_feedback_date ASC";

        $postComments = Yii::app()->db->createCommand($sql)->queryAll();

        if($postComments)
            return $postComments;
        else
            return null;

    }

    public static function getUserStats($listingId){

        if( empty($listingId) ){

            return false;
        }

        $result = array();

        $sql = "SELECT u.user_default_id as user_id, u.user_default_username as username,user_default_profile_image,u.user_default_first_name,u.user_default_surname,sum(user_default_feedback_likes_total) as like_total, sum(user_default_feedback_dislikes_total) as dislike_total, (sum(user_default_feedback_likes_total) - sum(user_default_feedback_dislikes_total)) as user_default_reputation ";
        $sql .= "FROM {{interactions}} c ";
        $sql .= " INNER JOIN {{sample_listing_feedbacks}} u1";
        $sql .= " ON c.user_default_profile_id = u1.user_default_profiles_id";
        $sql .= " INNER JOIN {{profiles}} u ";
        $sql .= "ON c.user_default_profile_id = u.user_default_id ";

        $sql .= "WHERE u1.user_default_sample_listing_id = {$listingId}";
        $sql .= " GROUP BY c.user_default_profile_id";

        $usersStats = Yii::app()->db->createCommand($sql)->queryAll();

        if( $usersStats ){

            foreach ($usersStats as $userStats) {

                $result[$userStats['user_id']] = $userStats;

            }

            return $result;
        }
        else
            return null;

    }


    public static function getTotalFeedbacks($id){

        $sql = "SELECT COUNT(*) as total_comments ";
        $sql .= "FROM {{sample_listing_feedbacks}} where user_default_sample_listing_id = {$id} ";

        return $totalComments = Yii::app()->db->createCommand($sql)->queryAll();

        // return (int) $totalComments[0]['total_comments'];

    }

    public static function getTotalFeedbacksbyrating($id,$rating){

        $sql = "SELECT sum(user_default_sample_listing_feedback_rating) as total , COUNT(*) as ratings ";
        $sql .= "FROM {{sample_listing_feedbacks}} where user_default_sample_listing_id = {$id} and user_default_sample_listing_feedback_rating = {$rating} ";

        return $totalComments = Yii::app()->db->createCommand($sql)->queryAll();

        // return (int) $totalComments[0]['total_comments'];

    }

    public static function getTotalFeedbacksbyid($id){

        $sql = "SELECT sum(user_default_sample_listing_feedback_rating) as ratings ";
        $sql .= "FROM {{sample_listing_feedbacks}} where user_default_sample_listing_id = {$id}";

        return $totalComments = Yii::app()->db->createCommand($sql)->queryAll();

        //  return (int) $totalComments[0]['total_comments'];

    }


    public static $commentViewLimit = 6;

    // Default offset to get comment
    public static $commentViewOffset = 0;

    // Default order by value
    public static $commentOrderBy = 'user_default_sample_listing_feedback_date DESC';

    // User default value
    public static $userProfession = '0';

    // Directory for upload attachement
    public static $uploadDirectoryPath = 'upload/comments/large/';

    public static $uploadThumbDirectoryPath = 'upload/comments/thumb/';

    // Max size file to upload ( 2 MB )
    public static $maxUploadFile = 2097152;

    // Allowed mime type for file to upload
    public static $allowedUploadType = array("application/pdf", "application/zip", "application/x-rar-compressed", "application/x-compressed", "image/jpg", "image/jpeg", "image/png", "image/bmp", "image/gif", "image/thm", "image/tif");

    public static $allowedThumbUploadType = array("image/jpg", "image/jpeg", "image/png", "image/bmp", "image/gif", "image/thm", "image/tif");
    // Forum administrator email


    // Key to use when checking admin connection (manage spam comments)
    public static $key = "U:h4y)f9";

    /*

     public static $adminMail = $adminMail;

     function __construct()
    {
        self::$adminMail = Yii::app()->params['company_cc_mail'];
    }
   */
    public static function formatDate($date) {

        if( empty($date) )
            return NULL;

        $result['time'] = date('h:i A', strtotime($date));

        $result['date'] = date('d/m/Y', strtotime($date));

        return $result;

    }



    /**
     * Get the view pagination
     *
     * @param $viewLimitValue number of comment to display
     * @param $pageSelected seleted page
     * @param $commentOrderBy Criteria Order by val of comment to display
     * @param $listingId number of comment to display
     * @param $userProfession number of comment to display
     *
     * @return pagination view
     *
     */

    public static function renderPagination( $viewLimitValue, $pageSelected, $commentOrderBy, $listingId, $userProfession) {

        $viewLimitValue = ( isset($viewLimitValue) ) ? $viewLimitValue : ForumClass::$commentViewLimit;
        $viewOffset = ( isset($viewOffset) ) ? $viewOffset : ForumClass::$commentViewOffset;
        $commentOrderBy = ( isset($commentOrderBy) ) ? $commentOrderBy : ForumClass::$commentOrderBy;
        $userProfession = ( isset($userProfession) ) ? $userProfession : ForumClass::$userProfession;

        $limit = $viewLimitValue;
        $offset = $viewOffset;

        if( ($commentOrderBy != "user_default_reputation desc") && ($commentOrderBy != "user_default_reputation asc") && ($userProfession == "0") ){

            $sql = "SELECT COUNT(*) as total_post";
            $sql .= " FROM {{sample_listing_feedbacks}}";
            $sql .= " WHERE user_default_first_feedback = '1'";
            $sql .= " AND user_default_sample_listing_id = {$listingId}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }elseif ( (($commentOrderBy == "user_default_reputation desc") || ($commentOrderBy == "user_default_reputation asc")) && ($userProfession == "0") ) {

            $sql = "SELECT COUNT(c1.user_default_sample_listing_id) as total_post FROM {{sample_listing_feedbacks}} c1 ";
            $sql .= " INNER JOIN (";
            $sql .= " SELECT u.user_default_id as user_id, (sum(user_default_feedback_likes_total) - sum(user_default_feedback_dislikes_total)) AS user_default_reputation";
            $sql .= " FROM {{sample_listing_feedbacks}} c2";
            $sql .= " INNER JOIN {{profiles}} u";
            $sql .= " ON c2.user_default_profiles_id = u.user_default_id";
            $sql .= " WHERE c2.user_default_sample_listing_id = {$listingId}";
            $sql .= " GROUP BY c2.user_default_profiles_id) z";
            $sql .= " ON z.user_id = c1.user_default_profiles_id";
            $sql .= " WHERE c1.user_default_first_feedback = '1'";
            $sql .= " AND c1.user_default_sample_listing_id = {$listingId}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }elseif ( ($commentOrderBy != "user_default_reputation desc") && ($commentOrderBy != "user_default_reputation asc") && ($userProfession != "0") ) {

            $sql = "SELECT COUNT(c.user_default_sample_listing_id) as total_post FROM {{sample_listing_feedbacks}} c";
            $sql .= " INNER JOIN {{profiles}} u";
            $sql .= " ON c.user_default_profiles_id = u.user_default_id";
            $sql .= " INNER JOIN {{profession}} p";
            $sql .= " ON u.user_default_profession = p.profession_id";
            $sql .= " WHERE c.user_default_first_feedback = '1'";
            $sql .= " AND c.user_default_sample_listing_id = {$listingId}";
            $sql .= " AND p.profession_id = {$userProfession}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }elseif ( (($commentOrderBy == "user_default_reputation desc") || ($commentOrderBy == "user_default_reputation asc")) && ($userProfession != "0") ) {

            $sql = "SELECT COUNT(c1.user_default_sample_listing_id) as total_post FROM {{sample_listing_feedbacks}} c1";
            $sql .= " INNER JOIN (";
            $sql .= " SELECT u.user_default_id as user_id, (sum(user_default_feedback_likes_total) - sum(user_default_feedback_dislikes_total)) AS user_default_reputation";
            $sql .= " FROM {{sample_listing_feedbacks}} c2";
            $sql .= " INNER JOIN {{profiles}} u";
            $sql .= " ON c2.user_default_profiles_id = u.user_default_id";
            $sql .= " INNER JOIN {{profession}} p";
            $sql .= " ON u.user_default_profession = p.profession_id";
            $sql .= " WHERE c2.user_default_sample_listing_id = {$listingId}";
            $sql .= " AND p.profession_id = {$userProfession}";
            $sql .= " GROUP BY c2.user_default_profiles_id) z";
            $sql .= " ON z.user_id = c1.user_default_profiles_id";
            $sql .= " WHERE c1.user_default_first_feedback = '1'";
            $sql .= " AND c1.user_default_sample_listing_id = {$listingId}";
            $sql .= " LIMIT {$offset}, {$limit}; ";

            $totalPosts = Yii::app()->db->createCommand($sql)->queryAll();
            $nbOfPost = (int) $totalPosts[0]['total_post'];

        }

        //echo $sql;


        // All posts in one page
        if( $nbOfPost <= $viewLimitValue ){

            $paginationContent = "<a class='active'>Page 1</a>";

        }else{

            // Get the previous page if the select page isn't the first
            if( ($pageSelected != 1) ){

                $previousPage = (int) ($pageSelected - 1);

                $offset = (int) (($previousPage - 1) * $viewLimitValue);

                $paginationContent = "<a style='cursor:pointer' orderby='{$commentOrderBy}' offset='{$offset}' page='{$previousPage}'>< Previous</a>";

            }

            // Loop the pagination on depend the limit view
            for ($i = 1; $i <= ($nbOfPost / $viewLimitValue); $i++) {

                $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";

                $offset = (int) (($i - 1) * $viewLimitValue);

                $paginationContent .= "<a style='cursor:pointer' orderby='{$commentOrderBy}' offset='{$offset}' page='{$i}' {$activeClass}>{$i}</a>";
            }

            // Get the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost ){

                $nexPage = (int) ($pageSelected + 1);

                $offset = (int) (($nexPage - 1) * $viewLimitValue);

                $koffset = (int) (($i - 1) * $viewLimitValue);

                $activeClass =  ($i == $pageSelected ) ? "class='active'" : "";

                $paginationContent .= "<a style='cursor:pointer' orderby='{$commentOrderBy}' offset='{$koffset}' {$activeClass} page='{$i}'>{$i}</a>";
                $nextPagination = "<a style='cursor:pointer' orderby='{$commentOrderBy}' offset='{$offset}' page='{$nexPage}'>Next ></a>";

            }

            // Render the next page link
            if( ($pageSelected * $viewLimitValue) < $nbOfPost){

                $paginationContent .= $nextPagination;

            }

        }

        return $paginationContent;

    }

}

new Samplefeedback();