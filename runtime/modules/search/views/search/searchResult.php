<?php
$SearchKey = ($searchKey !='nosearchkey') ? $searchKey :'';
// Default values
if($searchViewLimit === NULL){
    $searchViewOffset = SearchClass::$searchViewOffset;
    $searchViewLimit = SearchClass::$searchViewLimit;
   $searchOrderBy = SearchClass::$searchOrderBy;
}

$pageSelected = ( $pageSelected !== NULL ) ? $pageSelected : 1;
$searchCriteria = (isset($searchCriteria)? $searchCriteria : SearchClass::$searchCriteria);
$searchOrderBy = (isset($searchOrderBy)? $searchOrderBy : SearchClass::$searchOrderBy);

$listings = array();
$allListingData = array();
$totalSearchListings = 0;
$totalListings = 0;
if($SearchKey){
		$listings = UserDefaultListing::homeSearch($SearchKey, $searchCriteria, $searchViewOffset, $searchViewLimit, $searchOrderBy);
		$totalSearchListings = UserDefaultListing::countByHomeSearch($SearchKey, $searchCriteria,  $searchOrderBy);
		$classClose = 'pu-close'; /*close_search*/
		$viewLimitId = 'viewLimit';
}
else{
	$searchKeyword =(isset($searchKeyword)? $searchKeyword:'Nostr');
	$searchListingTitle = (isset($searchListingTitle)? $searchListingTitle:'Nostr');
	$searchCategory = (isset($searchCategory)? $searchCategory : SearchClass::$searchCategory);
	
	$searchLookingFor = (isset($searchLookingFor)? $searchLookingFor :SearchClass::$searchLookingFor);
	$searchViewingLimitByCountry = (isset($searchViewingLimitByCountry)? $searchViewingLimitByCountry :SearchClass::$searchViewingLimitByCountry);
	$searchSortCondtion = (isset($searchSortCondtion)? $searchSortCondtion :'Nostr');
	$searchSortByValue = (isset($searchSortByValue)? $searchSortByValue :'Nostr');
	$allListingData = UserDefaultListing::allListingData($searchListingTitle,$searchViewOffset, $searchViewLimit, $searchOrderBy , $searchCategory , $searchLookingFor , $searchViewingLimitByCountry,$searchKeyword,$searchSortCondtion,$searchSortByValue);
	
	$totalListings = sizeof($allListingData);
	$classClose = 'pu-close';
	$viewLimitId = 'viewLimitSearchKeyNull';
}

$listingsDetails = ($listings) ? $listings : $allListingData;
$totalSearchResults = ($totalSearchListings !=0) ? $totalSearchListings : $totalListings;
?>

<div class="searchPage" style="margin-top: -100px;">

<div style="width: 100%">
    <div style="float: left;margin-top: -93px;">
        <?php
        $resultsFor = array();
        if(!empty($searchKeyword) && $searchKeyword !='Nostr' && $searchKeyword!= 'all'){
            $resultsFor[] = $searchKeyword;
        }if(!empty($searchListingTitle) && $searchListingTitle != 'Nostr' && $searchListingTitle!='all'){
            $resultsFor[] = $searchListingTitle;
            /* }if(!empty($searchCategory) && $searchCategory !='Nostr' && $searchCategory !='all'){
                 $resultsFor[] =$searchCategory;
             }if(!empty($searchLookingFor) && $searchLookingFor !='Nostr' && $searchLookingFor !='all'){
                 $resultsFor[] =$searchLookingFor;
             }
             if(!empty($searchViewingLimitByCountry) && $searchViewingLimitByCountry !='Nostr' && $searchViewingLimitByCountry !='all'){
                 $resultsFor[] =$searchViewingLimitByCountry;
            */ }
        $resultsForSearchCondition = ($searchKey != '')?$searchKey:implode(',',$resultsFor);
        if($resultsForSearchCondition){
        ?>
        <h1 style="font-size: 1.5em;">
            Results for <span style="color:#e5a04d;">
                <?php echo $resultsForSearchCondition; ?>
            </span></h1>
        <?php } ?>
        <h5 style="color:#A84793; font-size: 0.9em;">
            <?php echo $totalSearchResults;?> results found</h5>
    </div>
    <div>
        <center>
            <h1 style="font-size: 2em;color: #16aeef">refine your search</h1>
        </center>
        <p style="text-align: center; color:#808080;"><em>Click the search button to execute a new search</em></p>
    </div>
</div>
<div  style="height:35px;margin-top: 20px;margin-bottom:-3px">
 <ul style="list-style-type: none;margin: 0;padding: 0;display: inline-flex;" >
  <li>
   <h5 class="searchlabel" title="Enter all or part of the listing title"> Listing title: <span id="searchListingTitle">
    <input type="text" name="search_listing_title" id="search_listing_title" value="<?php echo ($searchListingTitle !='Nostr') ? $searchListingTitle : '' ;?>" size="50"  />
    </span></h5>
  </li>
  <li  style="margin-left:24px">
   <h5 class="searchlabel" title="Enter keywords to refine your search">keyword: <span id="searchKeyword">
    <input type="text" name="search_keyword" id="search_keyword" value="<?php echo ($searchKeyword !='Nostr') ? $searchKeyword : '' ;?>" style="width: 186px;">
    </span> </h5>
  </li>
  <li style="margin-left:12px">
   <div >&nbsp;<span id="searchUsername">
    <input type="submit" title="Click to execute the search with the values you have selected" id="searchSubmitAll" class="button black" value="Search" name="Search" style="padding:  3px 13px;color: #fff;border-radius: 0;font-size: 13px;"/>
    </span></div>
  </li>
 </ul>
</div>
<div style="margin-bottom:30px">
 <ul style="list-style-type: none;margin: 0;padding: 0;display: inline-flex;">
  <li style="margin-right: 5px">
   <div class="searchlabel" title="Select a category from the drop down menu">Category:</div>
   <select class="chzn-select" name="categoryId" id="categoryId" style="width:105px !important">
    <option value="all" >All</option>
    <?php
			$listingCategories = ListingCategory::model()->findAll(array('order'=>'user_default_listing_category_sort_order'));
			foreach($listingCategories as $listingCategory):
                ?>
    <option value="<?php echo $listingCategory->user_default_listing_category_id;?>" <?php if( $searchCategory == $listingCategory->user_default_listing_category_id ) echo "selected";?>><?php echo $listingCategory->user_default_listing_category_name?></option>
    <?php endforeach;?>
   </select>
  </li>
  <li style="margin-right: 9px">
   <div class="searchlabel" title="Select from the drop down menu">Looking for:</div>
   <select class="chzn-select" name="lookingfor" id="lookingfor">
    <?php $listingLookingFor = ListingLookingfor::model()->findAll(array('order'=>'user_default_listing_lookingfor_sort_order'));?>
    <option value="all">All</option>
    <?php foreach($listingLookingFor as $lookingfor):?>
    <option value="<?php echo $lookingfor->user_default_listing_lookingfor_id;?>" <?php if( $searchLookingFor == $lookingfor->user_default_listing_lookingfor_id ) echo "selected";?>><?php echo $lookingfor->user_default_listing_lookingfor_name;?></option>
    <?php endforeach;?>
   </select>
  </li>
  <li style="margin-right: 9px">
   <div class="searchlabel" title="Select from the drop down menu">Criteria:</div>
   <select class="chzn-select" name="criteria" id="criteria"  style="width:150px !important">
    <option value="all">All</option>
    <option value="listing_investment">Listings looking for investment</option>
    <option value="listing_auction">Listings open for auction</option>
    <option value="listing_prize_points">Listing offering prize points</option>
    <option value="listing_offering">Listings offering samples</option>
    <option value="favourites">My favourites</option>
   </select>
  </li>
  <li style="margin-right: 9px">
   <div class="searchlabel" title="Select from the drop down menu">Viewing limit:</div>
   <select class="chzn-select" name="viewinglimit" id="viewinglimit" style="width:167px">
    <?php $countries = Country::model()->findAll();?>
    <option value="all">Worldwide</option>
    <?php foreach($countries as $country):?>
    <option value="<?php echo $country->user_default_country_id; ?>" <?php if( $searchViewingLimitByCountry == $country->user_default_country_id ) echo "selected";?>><?php echo $country->user_default_country_name;?></option>
    <?php endforeach; ?>
   </select>
  </li>
  <li style="margin-right: 9px">
   <div class="searchlabel" title="Select from the drop down menu">Sort by:</div>
   <select class="chzn-select" name="sortby" id="sortby" style="width:145px !important" >
    <option value="user_default_listing_approvedate DESC">Please select</option>
    <option value="user_default_listing_approvedate DESC" <?php if($searchOrderBy == 'user_default_listing_approvedate DESC'){?> selected <?php } ?>>Recent</option>
    <option value="user_default_listing_approvedate ASC" <?php if($searchOrderBy == 'user_default_listing_approvedate ASC'){?> selected <?php } ?>>Oldest</option>
    <option value="relevance" <?php if($searchOrderBy == 'relevance') echo 'selected'; ?> >Relevance</option>
    <option value="listing_title" <?php if($searchOrderBy == 'listing_title') echo 'selected';?>>Listing title</option>
   </select>
  </li>
 </ul>
</div>
<span id="searchbyRL" style="display: none;width: 137px !important;float: right;margin-top: -19px;margin-right: 27px;">
<input type="text" value="<?php echo ($searchSortByValue !='Nostr')?$searchSortByValue:'';?>" id="searchbyRLValue" name="searchbyRL" size="10" style="width:137px !important" >
</span>

<div class="clearfix">&nbsp;</div>
<?php if( $totalSearchResults > 0 ){?>
   <?php if(!empty($SearchKey)){

        $searchTblClass = 'searchTbl';

    }else{

        $searchTblClass = 'searchTblNull';

    }?>
<table  class="<?php echo $searchTblClass;?>" style="width:100%;">
 <tbody>
  <?php


        if($listingsDetails) {



            foreach ($listingsDetails as $index => $listingData):



                if ($index % 2 == 0) {



                    $class = 'MauveRow';



                } else {



                    $class = 'GreyRow';



                }



                ?>
  <tr class="<?php echo $class; ?>" onclick="document.location = '<?php echo Yii::app()->getBaseUrl().'/listing/view?id='.$listingData['user_default_listing_id'];?>';">
   <td style="width:20%;vertical-align: top;"><?php



                        $user = new User();



                        $userData = User::model()->findByAttributes(array('user_default_id'=>$listingData['user_default_profiles_id']));



                        $user_dirname = strtolower($userData['user_default_username'])."_".$userData['user_default_id'];



                        $img_path = Yii::app()->getBaseUrl(true).'/upload/users/'.$user_dirname.'/listing/thumb/'.$listingData['user_default_listing_thumbnail'];



                        ?>
    <img src="<?php echo $img_path; ?>" class="searchImage image-bg" alt="Logo" /></td>
   <td style="width:80%;vertical-align: top;"><div class="listing_title"><a href="<?php echo Yii::app()->getBaseUrl().'/listing/view?id='.$listingData['user_default_listing_id'];?>"><?php echo $listingData['user_default_listing_title'] ?></a></div>
    <?php   echo '<div class="listing_desc">'.$listingData['user_default_listing_what_is_it'].'</div>';



                        echo $listingData['user_default_listing_summary'];?></td>
  </tr>
  <?php endforeach;



        } ?>
 </tbody>
</table>  
<?php }else{






?>
<div class="search-null">
<div>
 <div style="margin: -5px 28px 0 0;"> <a class="<?php echo $classClose;?>" title="Close"



                href="<?php echo Yii::app()->baseUrl;?>/search">X</a> </div>
 <?php echo '<div style="font-size: small;">';



            echo 'Your search criteria did not yield any results<br /> Please modify your search and try again</div>';



            echo '</div></div>';



        } ?>
 <div class="clear"></div>
 <div class="clear"></div>
 <div class="user-pagination"> 
  
  <!-- Number of records to view drop down menu -->
  
  <div class="search-page-nav">
   <?php   // if($SearchKey) {?>
   <div style="width: 100px;">
    <div style="float: left; padding-top: 5px;"> <span title="Select number of records to view from the dropdown menu" style="color: #A84793; ">View</span> </div>
    <div style="float: right;">
     <select data-placeholder=" " class="chzn-select" style="width: 60px; display: none;" tabindex="-1" id="<?php echo $viewLimitId;?>" name="viewLimit">
      <option value="6"<?php if( $searchViewLimit == 6 ) echo "selected";?>>6</option>
      <option value="12"<?php if( $searchViewLimit == 12 ) echo "selected";?>>12</option>
      <option value="25"<?php if( $searchViewLimit == 25 ) echo "selected";?>>25</option>
      <option value="50"<?php if( $searchViewLimit == 50 ) echo "selected";?>>50</option>
      <option value="100"<?php if( $searchViewLimit == 100 ) echo "selected";?>>100</option>
     </select>
     <script type="text/javascript"> $(".chzn-select").chosen();</script> 
    </div>
   </div>
   <?php //} ?>
  </div>
  
  <!-- Bottom navigation menu -->
  
  <?php $searchPageNoClass = ($SearchKey) ? 'SearchPageNumbers': 'SearchNullPageNumbers';?>
  <div class="page_numbers <?php echo $searchPageNoClass;?>" style="margin-top: -25px; margin-right: 17px;">
   <?php



                    if($SearchKey) {



                        echo SearchClass::renderPagination($searchViewLimit, $pageSelected, $searchOrderBy, $SearchKey);



                    }



                    else{



                        // echo $searchViewLimit, $pageSelected, $searchOrderBy, $searchListingTitle,$searchuserName,$searchCategory,$searchLookingFor,$searchViewingLimitByCountry, $searchSortCondtion,$searchSortByValue;



                        echo SearchClass::renderPaginationSearchNull($searchViewLimit, $pageSelected, $searchOrderBy, $searchListingTitle,$searchuserName,$searchCategory,$searchLookingFor,$searchViewingLimitByCountry, $searchSortCondtion,$searchSortByValue);



                    }



                    ?>
   <input type='hidden' id='commentViewLimit' value='<?=$searchViewLimit;?>' />
   <input type='hidden' id='searchKey' value='<?=$SearchKey;?>' />
  </div>
 </div>
</div>
<script type="text/javascript">



    $(".chzn-select").chosen();



    $('#search').hide();



    $("input[type=radio]").click(function(){



        var searchBy = $(this).attr('id');



        if(searchBy == 'searchRelevance' || searchBy == 'searchByTitle' ){



            $('#search').show();



        }



        else if(searchBy == 'searchByRecent' || searchBy == 'searchOldest' )



        {



            $('#search').hide();



            var orderBy = $(this).val();



            $('#search-form').submit();



        }



    });



    $('#sortby').on('change', function(){



        var sortby = $('#sortby').val();



        if(sortby == 'relevance' ||  sortby === 'listing_title'){



            $('span#searchbyRL').val('');



            $('span#searchbyRL').show();



            return;



        }



        else{



            old$('span#searchbyRL').hide();



        }



    });



</script>