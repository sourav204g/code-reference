$('.home-exp-sec.services a.learn-more.reveal').click(function(e){

  e.preventDefault();

  // console.log('reveal it!');

  let title = $(this).data('title');

  let count = $(this).data('count');

  let term_id = $(this).data('cid');

  let banner_text = $(this).data('banner-text') ?? '';

  let banner_link = $(this).data('banner-link') ?? '';

  $('.revealed-box').remove();

  let body = '';

  body += `<div class="col-lg-12 revealed-box">

              <div class="toggle-panel">

                <div class="row toggle-head-row">

                  <div class="col-md-4 col-10">

                    <h4>${title} <span>${count} Services Available</span></h4>

                  </div>

                  <div class="col-md-8 col-12 desk-sec">

                    <div class="handyman-price-btn-wrapper">

                      <a href="${banner_link}">${banner_text}</a>

                    </div>

                  </div>
                  <button class="toggle-close"><i class="fa fa-times"></i></button>

                </div>

                <div class="row list-row loading"><div class="col-md-12">Loading...</div></div>

                <div class="row mob-sec">
                  <div class="col-lg-12">
                    <div class="handyman-price-btn-wrapper">
                      <a href="${banner_link}">${banner_text}</a>
                    </div>
                  </div>
                </div>


              </div>

            </div>`;

              $.ajax({

                  type: 'POST',

                  url: handymanx_fnt.root + '/wp-admin/admin-ajax.php', // Change path

                  data: {

                            action: 'reveal_services_by_cat',

                            search: term_id,

                            autosecurity: handymanx_fnt.nonce

                        },

                  success: function(data) {

                    // console.log(data);                  

                    let res = $.parseJSON(data);

                    let markup = '';

                    res = Object.values(res);

                    console.log(res);

                    res.forEach(function(item, index){ 

                    

                      if (item.type.length > 1) {

                          markup += '<div class="col-lg-3"><div class="reveal-prd-wrapper"><span>' + item.name + '</span><br><a href="' + item.group + '">' + item.type[0].markup + '<br/>' + item.type[1].markup + '</a></div></div>';

                      } else {

                          markup += '<div class="col-lg-3"><div class="reveal-prd-wrapper"><span>' + item.name + '</span><br><a href="' + item.type[0].permalink + '">' + item.type[0].markup +'</a></div></div>';

                      }
                           

                    });

                    $('.list-row.loading').html('');

                    $('.list-row.loading').html(markup);              

                           

                  }

              });


              if (window.outerWidth < 768 ) {

                $(this).parents('.col-md-3').after(body);

              } else {

                $(this).parents('.row').append(body);

              }

});

$('body').on('click', '.revealed-box .toggle-close', function(e){  

  e.preventDefault();

  $('.revealed-box').remove();
  $('.handypro-box.current').removeClass('current');


});