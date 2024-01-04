		<?php global $tabID; 
	  global $Areviews; 
	  global $Oreviews; 

?>

<style>
	/*.hxd-hide-r { display: none; }*/ .pro-border2 { padding:16px; }
	.hxnd-showreview {
	    overflow: hidden;
	    overflow-y: auto;
	    height: 300px;
	    box-shadow: inset 0px 0px 14px 0px #ddd;
	    padding: 30px 0;
	}

	.hnd-box5 { display: none; }
    .over-rating h3{
       font-size: 17px;
       color: #323232;
       margin-bottom: 10px;
    }

    .over-rating h3 span{
       font-size: 21px;
       color: #323232;
       font-weight: 600;
       margin-right: 5px;
       margin-left: 5px;
    }

    .over-rating h3 i{
       font-size: 20px;
       color: #ffaf00;
       font-weight:300;
    }

    .over-rating h3 .rview{
       font-size:15px !important;
       color: #323232;
       margin-left: 8px;
       font-weight:300 !important;
    }

    .grade2 {
    position: absolute;
    z-index: 99;
    background: unset;
    padding: 5px 5px;
    right: 5px;
    top: 5px;
    font-size: 42px;
    color: #dc3545;
}
.grade2 .nav-link {
    display: block;
    padding: unset !important;
}

.testi-new h3{
	font-size: 19px;
	font-weight: 600;
	margin-bottom: 8px;
	text-transform: capitalize;
}

.testi-new h3 span{
	font-size: 18px;
	font-weight: 500;
	margin-left: 25px;
}

.over-box{
	border: 1px solid #cae0e7;
    background: #fff;
    padding: 20px !important;
    width: 100% !important;
    margin-bottom:5px;
    position: relative;
    border-radius: 5px;
}

.over-box .table th {
    padding: 3.5px;
    vertical-align: top;
    border-top: unset;
}

.over-box .table td {
    padding: 2.5px;
    vertical-align: top;
    border-top: unset;
}


.over-box .table td i{
    color: #ffaf00;
    font-size: 18px;
}

.over-box .table th i{
    color: #ffaf00;
    font-size: 18px;
}

.over-box .table{
 margin-bottom: 0;
}

.review-box2 {
    margin-top:10px !important;
}

.services-provider{
	    background: #f2f5f8db;
    padding: 15px;
    border-radius: 5px;
    margin-top: 25px;
    margin-bottom: 10px;
}

.services-provider h3{
	    font-size:17px;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.review-box2 p{
	margin-bottom:12px;
}


.review-box2 a{
	font-size: 17px;
	color: #009c06;
	text-decoration: underline;
	margin-left: 25px;
}

.rr_review_text a{
	color:#e74c3c !important;
	margin-left: 25px;
}

.review-box2 span{
	font-size: 17px;
	color: #323232;
}




</style>
<div class="row">
	<div class="col-md-12">
		<div class="reviews-new hnd-box5 hxnd-pro-reviews-<?php echo $post->ID; ?>" style="width: 100%; margin-top:12px;">
			<div>
				<div class="col-xs-12">
					
					<nav>
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

							<a aria-controls="nav-home" aria-selected="true" class="nav-item nav-link active positive-tab" data-toggle="tab" href="#nav-home<?php echo $tabID; ?>" id="nav-home-tab<?php echo $tabID; ?>" role="tab">(<?php echo $Areviews['count(*)']; ?>) Positive</a>

							<!-- <a aria-controls="nav-profile" aria-selected="false" class="nav-item nav-link negative-tab" data-toggle="tab" href="#nav-profile<?php // echo $tabID; ?>" id="nav-profile-tab<?php // echo $tabID; ?>" role="tab">(<?php // echo $Oreviews['count(*)']; ?>) Disputed</a> -->

							<a aria-controls="nav-contact" aria-selected="false" class="nav-item nav-link box1" id="nav-contact-tab" role="tab">Close</a>

						</div>
					</nav>

					<div class="tab-content tab-content-hnd py-3 px-3 px-sm-0" id="nav-tabContent">
						
<div aria-labelledby="nav-home-tab<?php echo $tabID; ?>" data-id="<?php echo $post->ID; ?>" data-t="positive" class="tab-pane fade show active" id="nav-home<?php echo $tabID; ?>" role="tabpanel">
	<div id="reviews-new">
		<div class="block less-top" style="padding-bottom: 0px;">
			<div class="container">
				<div class="content">
					<div class="loadMore1">

						<div class="pro-border over-rating">
                        <div class="row">
                           <div class="col-md-7">
                           <h3>	Overall Rating: <span>4.8</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span class="rview">50 Reviews</span></h3>
                           </div>
                           <div class="col-md-3">
                           	Short by: 
                           	<select class="hnd-order-reviews" data-id="<?php echo $post->ID; ?>">
							  <option value="new">Newest</option>
							  <option value="high">Highest Rating</option>
							  <option value="low">Lowest Rating</option>
							</select>
                           </div>
                           <div class="col-md-2"></div>
						</div>




							<div class="grade2">
								<a aria-controls="nav-contact" aria-selected="false" class="nav-item nav-link box1" ><i class="fa fa-times" aria-hidden="true"></i></a>
							</div>
							<div class="row">

								<div class="col-md-12">
									
									
									
									<div class="customerbox">
					

<!-- <h3>Customer Comments</h3>  -->

<!-- New review	STRAT-->	
<!-- <div class="testimonial_group">
	<div class="testimonial">

		<div class="row">
			<div class="col-md-8 col-sm-12 testi-new">
			<div class="review-box2">
			<h3>Debra B City Vernon Hills IL <span>Job Date: 12/02/2020</span></h3>
			<p><span>Job: $250.90</span> <a data-toggle="modal" href="#reviewdetails">See Details>></a></p>
			<div class="rr_review_text">
			<span class="drop_cap">“</span><span itemprop="reviewBody">RRPERFECT!!!! Will do business again with Handyman Pros!!!! Excellent customer service!!!!</span>”<a href="#" class="read_more">Read More</a></div></div>
            
            <div class="services-provider">
			<h3>Services Provider Response</span></h3>
			<div class="rr_review_text">
			<span class="drop_cap">“</span><span itemprop="reviewBody">RRPERFECT!!!! Will do business again with Handyman Pros!!!! Excellent customer service!!!!</span>” <a href="#" class="read_more">Read More</a></div>
		    </div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="over-box">
					<table class="table">
						  <thead>
						    <tr>
						      <th scope="col">OVERALL</th>
						      <th scope="col"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">Price</th>
						      <td><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i></td>
						      
						    </tr>
						    <tr>
						      <th scope="row">Quality</th>
						      <td><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></td>
						    </tr>
						    <tr>
						      <th scope="row">Cleanliness</th>
						      <td><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></td>
						    </tr>
						    <tr>
						      <th scope="row">Responsiveness</th>
						      <td><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i></td>
						    </tr>
						    <tr>
						      <th scope="row">Punctuality</th>
						      <td><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></td>
						    </tr>
						     <tr>
						      <th scope="row">Professonalism</th>
						      <td><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></td>
						    </tr>
						   
						  </tbody>
						</table>
				</div>
			</div>
		</div>
		

			
		</div>
</div> -->
<!-- New review	END-->

										<div class="hxnd-showreview hxnd-showreview-<?php echo $post->ID; ?>">
                                     
										Loading..</div>
									</div>
									
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<div aria-labelledby="nav-profile-tab<?php echo $tabID; ?>" data-id="<?php echo $post->ID; ?>" data-t="disputed" class="tab-pane fade" id="nav-profile<?php echo $tabID; ?>" role="tabpanel">
<div id="reviews-new">
<div class="block less-top" style="padding-bottom: 0px;">
<div class="container">
<div class="content">
	<div class="loadMore1">

		<div class="pro-border">
			<div class="grade">
				C
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- <div class="pro-border2">
						<p><strong>Customer Name:</strong> R. Bill<br>
						<strong>City:</strong> South Barrington<br>
						<strong>Job Date:</strong> 10/26/2017</p>
					</div> -->
					<div class="customerbox">
						<h3>Customer Comments</h3>
						<div class="hxnd-showreview hxnd-showreview-<?php echo $post->ID; ?>">Loading..</div>
					</div>
					
				</div>
			</div>
		</div>

	</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Review Details Modal -->
  <div class="modal hide" id="reviewdetails" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content" style="overflow: hidden;">
        <div class="modal-header">
          <h4 class="modal-title" style="margin-left: 15px;">Debra B City Vernon Hills IL </h4>
          <button type="button" style="margin-right: 15px;" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body higher hnd-preview">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>