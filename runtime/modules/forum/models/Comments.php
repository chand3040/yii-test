<?php

/**
 * This is the model class for table "{{interactions}}".
 *
 * The followings are the available columns in table '{{interactions}}':
 * @property integer $id
 * @property string $message
 * @property string $user_id
 * @property string $listing_id
 * @property string $likes_total
 * @property string $dislikes_total
 * @property string $attachement
 * @property string $thumb_attachment
 * @property string $is_spam
 * @property string $user_default_first_interations
 * @property string $date_create
 */
class Comments extends CActiveRecord
{

     public $thumb_attachment;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
		return '{{interactions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{		
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
					);
	}
        
        /**
         * Get the post comment for the current comment (user_default_first_interations)
         *
         * @param no params
         *
         * @return Array of posts comment
         *
        */        
        
        
        public function getPostComments(){  
		
        	$sql = "SELECT c.*";
            $sql .= "FROM {{interactions_messages}} pc ";
            $sql .= "INNER JOIN {{interactions}} c ";
            $sql .= " ON pc.user_default_interactions_message_id = c.user_default_interaction_id ";
            //$sql .= "INNER JOIN {{user}} u ";
            //$sql .= " ON c.user_id = u.drg_id ";
            $sql .= " WHERE pc.user_default_interaction_id = {$this->user_default_interaction_id}";
            $sql .= " ORDER BY c.user_default_date_create ASC";
            
        $postComments = Yii::app()->db->createCommand($sql)->queryAll();
            
	    if($postComments)
	        return $postComments;
	    else
	        return null;
        
        }
        
		public function getPostmessages($id){  
		
        	$sql = "SELECT c.*";
            $sql .= "FROM {{interactions_messages}} pc ";
            $sql .= "INNER JOIN {{interactions}} c ";
            $sql .= " ON pc.user_default_interactions_message_id = c.user_default_interaction_id ";
            //$sql .= "INNER JOIN {{user}} u ";
            //$sql .= " ON c.user_id = u.drg_id ";
            $sql .= " WHERE pc.user_default_interaction_id = {$id}";
            $sql .= " ORDER BY c.user_default_date_create ASC";
            
        $postComments = Yii::app()->db->createCommand($sql)->queryAll();
            
	    if($postComments)
	        return $postComments;
	    else
	        return null;
        
        }
        

        /**
         * List the comments
         *
         * @param $listingId
         * @param $offset
         * @param $limit
         * @param $commentOrderBy
         * @param $userReputation
         * @param $userProfession
         * 
         * @return new date formated
         *
        */        
        
        public static function getCommentsByListing($listingId, $offset, $limit, $commentOrderBy, $userReputation, $userProfession){
            
            $result = array();
            
            $CDbCriteria = FALSE;
            
            if( ($commentOrderBy != "user_default_reputation desc") && ($commentOrderBy != "user_default_reputation asc") && ($userProfession == "0") ){
                
                $criteria = new CDbCriteria;
                $criteria->select = array('*, (user_default_likes_total - user_default_dislikes_total) as rate');
                $criteria->addCondition('user_default_listing_id = '.$listingId);
                $criteria->addCondition("user_default_first_interations = '1'");
                $criteria->offset = $offset;
                $criteria->limit = $limit;
                $criteria->order = $commentOrderBy;
                
                $CDbCriteria = TRUE;
                
            }elseif ( (($commentOrderBy == "user_default_reputation desc") || ($commentOrderBy == "user_default_reputation asc")) && ($userProfession == "0") ) {
            
                $sql = "SELECT c1.id FROM {{interactions}} c1";
                $sql .= " INNER JOIN (";
                $sql .= " SELECT u.user_default_id as user_id, (sum(user_default_likes_total) - sum(user_default_dislikes_total)) AS user_default_reputation";
                $sql .= " FROM {{interactions}} c2";
                $sql .= " INNER JOIN {{profiles}} u";
                $sql .= " ON c2.user_default_profile_id = u.user_default_id";
                $sql .= " WHERE c2.user_default_listing_id = {$listingId}";
                $sql .= " GROUP BY c2.user_default_profile_id) z";
                $sql .= " ON z.user_default_profile_id = c1.user_default_profile_id";
                $sql .= " WHERE c1.user_default_first_interations = '1'";
                $sql .= " AND c1.user_default_listing_id = {$listingId}";
                $sql .= " ORDER BY z.{$commentOrderBy}";
                $sql .= " LIMIT {$offset}, {$limit}; ";
                
            }elseif ( ($commentOrderBy != "user_default_reputation desc") && ($commentOrderBy != "user_default_reputation asc") && ($userProfession != "0") ) {
                
                $sql = "SELECT c.id, (user_default_likes_total - user_default_dislikes_total) as rate FROM {{interactions}} c";
                $sql .= " INNER JOIN {{profiles}} u";
                $sql .= " ON c.user_default_profile_id = u.user_default_id";
                $sql .= " INNER JOIN {{profession}} p";
                $sql .= " ON u.user_default_profession = p.profession_id";
                $sql .= " WHERE c.user_default_first_interations = '1'";
                $sql .= " AND c.user_default_listing_id = {$listingId}";
                $sql .= " AND p.profession_id = {$userProfession}";
                $sql .= " ORDER BY {$commentOrderBy}";
                $sql .= " LIMIT {$offset}, {$limit}; ";
                
            }elseif ( (($commentOrderBy == "user_default_reputation desc") || ($commentOrderBy == "user_default_reputation asc")) && ($userProfession != "0") ) {
            
                $sql = "SELECT c1.id, z.user_default_reputation FROM {{interactions}} c1";
                $sql .= " INNER JOIN (";
                $sql .= " SELECT u.user_default_id as user_id, (sum(user_default_likes_total) - sum(user_default_dislikes_total)) AS user_default_reputation";
                $sql .= " FROM {{interactions}} c2";
                $sql .= " INNER JOIN {{profiles}} u";
                $sql .= " ON c2.user_default_profile_id = u.user_default_id";
                $sql .= " INNER JOIN {{profession}} p";
                $sql .= " ON u.user_default_profession = p.profession_id";                
                $sql .= " WHERE c2.user_default_listing_id = {$listingId}";
                $sql .= " AND p.profession_id = {$userProfession}";
                $sql .= " GROUP BY c2.user_default_profile_id) z";
                $sql .= " ON z.user_default_profile_id = c1.user_default_profile_id";
                $sql .= " WHERE c1.user_default_first_interations = '1'";                
                $sql .= " AND c1.user_default_listing_id = {$listingId}";
                $sql .= " ORDER BY {$commentOrderBy}";
                $sql .= " LIMIT {$offset}, {$limit}; ";
                
            }
            
            if( !$CDbCriteria ){
                                
                $commentsCommand = Yii::app()->db->createCommand($sql)->queryAll();
                
                foreach ($commentsCommand as $commentCommand) {
                    
                    $comment = Comments::model()->findByPk($commentCommand['id']);
                    
                    $result[$comment->user_default_interaction_id]['comment'] = $comment;

                    $postComments = $comment->getPostComments();

                    $result[$comment->user_default_interaction_id]['post_comment'] = $postComments;
                }
                
            }else{
                                
                $comments = Comments::model()->findAll($criteria);
                
                foreach ($comments as $comment) {

                    $result[$comment->user_default_interaction_id]['comment'] = $comment;

                    $postComments = $comment->getPostComments();

                    $result[$comment->user_default_interaction_id]['post_comment'] = $postComments;

                }
                
            }
            
	    return $result;
        
        }
        
        // It's more better for performance to extract in one query the user stats (username, nb of likes, nb of dislike ) like that
        // than to make multiple query for each comment
        
        public static function getUserStats($listingId){
            
            if( empty($listingId) ){
                
                return false;
            }
            
            $result = array();
            
            $sql = "SELECT u.user_default_id as user_id, u.user_default_username as username,user_default_profile_image,u.user_default_first_name,u.user_default_surname,sum(user_default_likes_total) as like_total, sum(user_default_dislikes_total) as dislike_total, (sum(user_default_likes_total) - sum(user_default_dislikes_total)) as user_default_reputation ";
            $sql .= "FROM {{interactions}} c ";
            $sql .= "INNER JOIN {{profiles}} u ";
            $sql .= "ON c.user_default_profile_id = u.user_default_id ";
            $sql .= "WHERE c.user_default_listing_id = {$listingId}";
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
        
        
        public static function getTotalComments(){
            
            $sql = "SELECT COUNT(*) as total_comments ";
            $sql .= "FROM {{interactions}} c ";
            
            $totalComments = Yii::app()->db->createCommand($sql)->queryAll();
            
            return (int) $totalComments[0]['total_comments'];
            
        }

}