<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctokopedia extends CI_Controller {
	
	public function __construct(){
            
		parent::__construct();
		
		$this->load->model('mo_res');
	}
  
  public function index(){
		echo 'untuk tokopedia';
	}
  // LINK DAN BARANG INDEX

  public function get_data_produk_tokopedia($shop,$productKey){
        $payload = '[
            {
              "operationName": "PDPGetLayoutQuery",
              "variables": {
                "shopDomain": "'.$shop.'",
                "productKey": "'.$productKey.'",
                "layoutID": "",
                "apiVersion": 1,
                "userLocation": {
                  "addressID": "0",
                  "districtID": "2274",
                  "postalCode": "",
                  "latlon": ""
                },
                "extParam": ""
              },
              "query": "fragment ProductVariant on pdpDataProductVariant {\n  errorCode\n  parentID\n  defaultChild\n  sizeChart\n  variants {\n    productVariantID\n    variantID\n    name\n    identifier\n    option {\n      picture {\n        urlOriginal: url\n        urlThumbnail: url100\n        __typename\n      }\n      productVariantOptionID\n      variantUnitValueID\n      value\n      hex\n      __typename\n    }\n    __typename\n  }\n  children {\n    productID\n    price\n    priceFmt\n    optionID\n    productName\n    productURL\n    picture {\n      urlOriginal: url\n      urlThumbnail: url100\n      __typename\n    }\n    stock {\n      stock\n      isBuyable\n      stockWordingHTML\n      minimumOrder\n      maximumOrder\n      __typename\n    }\n    isCOD\n    isWishlist\n    campaignInfo {\n      campaignID\n      campaignType\n      campaignTypeName\n      campaignIdentifier\n      background\n      discountPercentage\n      originalPrice\n      discountPrice\n      stock\n      stockSoldPercentage\n      startDate\n      endDate\n      endDateUnix\n      appLinks\n      isAppsOnly\n      isActive\n      hideGimmick\n      isCheckImei\n      minOrder\n      __typename\n    }\n    thematicCampaign {\n      additionalInfo\n      background\n      campaignName\n      icon\n      __typename\n    }\n    __typename\n  }\n  __typename\n}\n\nfragment ProductMedia on pdpDataProductMedia {\n  media {\n    type\n    urlThumbnail: URLThumbnail\n    videoUrl: videoURLAndroid\n    prefix\n    suffix\n    description\n    __typename\n  }\n  videos {\n    source\n    url\n    __typename\n  }\n  __typename\n}\n\nfragment ProductHighlight on pdpDataProductContent {\n  name\n  price {\n    value\n    currency\n    __typename\n  }\n  campaign {\n    campaignID\n    campaignType\n    campaignTypeName\n    campaignIdentifier\n    background\n    percentageAmount\n    originalPrice\n    discountedPrice\n    originalStock\n    stock\n    stockSoldPercentage\n    threshold\n    startDate\n    endDate\n    endDateUnix\n    appLinks\n    isAppsOnly\n    isActive\n    hideGimmick\n    __typename\n  }\n  thematicCampaign {\n    additionalInfo\n    background\n    campaignName\n    icon\n    __typename\n  }\n  stock {\n    useStock\n    value\n    stockWording\n    __typename\n  }\n  variant {\n    isVariant\n    parentID\n    __typename\n  }\n  wholesale {\n    minQty\n    price {\n      value\n      currency\n      __typename\n    }\n    __typename\n  }\n  isCashback {\n    percentage\n    __typename\n  }\n  isTradeIn\n  isOS\n  isPowerMerchant\n  isWishlist\n  isCOD\n  isFreeOngkir {\n    isActive\n    __typename\n  }\n  preorder {\n    duration\n    timeUnit\n    isActive\n    preorderInDays\n    __typename\n  }\n  __typename\n}\n\nfragment ProductCustomInfo on pdpDataCustomInfo {\n  icon\n  title\n  isApplink\n  applink\n  separator\n  description\n  __typename\n}\n\nfragment ProductInfo on pdpDataProductInfo {\n  row\n  content {\n    title\n    subtitle\n    applink\n    __typename\n  }\n  __typename\n}\n\nfragment ProductDetail on pdpDataProductDetail {\n  content {\n    title\n    subtitle\n    applink\n    showAtFront\n    isAnnotation\n    __typename\n  }\n  __typename\n}\n\nfragment ProductDataInfo on pdpDataInfo {\n  icon\n  title\n  isApplink\n  applink\n  content {\n    icon\n    text\n    __typename\n  }\n  __typename\n}\n\nfragment ProductSocial on pdpDataSocialProof {\n  row\n  content {\n    icon\n    title\n    subtitle\n    applink\n    type\n    rating\n    __typename\n  }\n  __typename\n}\n\nquery PDPGetLayoutQuery($shopDomain: String, $productKey: String, $layoutID: String, $apiVersion: Float, $userLocation: pdpUserLocation, $extParam: String) {\n  pdpGetLayout(shopDomain: $shopDomain, productKey: $productKey, layoutID: $layoutID, apiVersion: $apiVersion, userLocation: $userLocation, extParam: $extParam) {\n    name\n    pdpSession\n    basicInfo {\n      alias\n      isQA\n      id: productID\n      shopID\n      shopName\n      minOrder\n      maxOrder\n      weight\n      weightUnit\n      condition\n      status\n      url\n      needPrescription\n      catalogID\n      isLeasing\n      isBlacklisted\n      menu {\n        id\n        name\n        url\n        __typename\n      }\n      category {\n        id\n        name\n        title\n        breadcrumbURL\n        isAdult\n        isKyc\n        minAge\n        detail {\n          id\n          name\n          breadcrumbURL\n          isAdult\n          __typename\n        }\n        __typename\n      }\n      txStats {\n        transactionSuccess\n        transactionReject\n        countSold\n        paymentVerified\n        itemSoldFmt\n        __typename\n      }\n      stats {\n        countView\n        countReview\n        countTalk\n        rating\n        __typename\n      }\n      __typename\n    }\n    components {\n      name\n      type\n      position\n      data {\n        ...ProductMedia\n        ...ProductHighlight\n        ...ProductInfo\n        ...ProductDetail\n        ...ProductSocial\n        ...ProductDataInfo\n        ...ProductCustomInfo\n        ...ProductVariant\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n"
            }
          ]';

        $ch = curl_init('https://gql.tokopedia.com/graphql/PDPGetLayoutQuery');
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Origin: https://www.tokopedia.com',
            'x-tkpd-lite-service: zeus',
            'x-device: desktop',
            'x-source: tokopedia-lite',
            'x-tkpd-akamai: pdpGetLayout',
            'x-tkpd-lite-service: zeus',
            'x-version: 41639d1',
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $resp = curl_exec($ch);
        curl_close($ch);

        $arr_resp = json_decode($resp,true);
        
        $jml_review = $arr_resp[0]['data']['pdpGetLayout']['basicInfo']['stats']['countReview'];
        $id_prod = $arr_resp[0]['data']['pdpGetLayout']['basicInfo']['id'];
        // echo $id_prod;
        $get_ulasan = $this->getReview(ceil($jml_review/1),$id_prod);
        $last_review = end($get_ulasan[0]['data']['ProductReviewListQueryV2']['list']);
        $tgl_last_review = date('Y-m-d H:i:s',$last_review['reviewCreateTimestamp']);

        $arr_resp['tgl_ulasan'] = $tgl_last_review;

        echo json_encode($arr_resp);        
        
	}

  public function getReview($page,$productID){
        $payload = '[
            {
                "operationName": "ProductReviewListQueryV2",
                "variables": {
                    "page": '.$page.',
                    "productID": "'.$productID.'",
                    "perPage": 1
                },
                "query": "query ProductReviewListQueryV2($productID: String!, $page: Int!, $perPage: Int!, $rating: Int!, $withAttachment: Int!) {\n  ProductReviewListQueryV2(productId: $productID, page: $page, perPage: $perPage, rating: $rating, withAttachment: $withAttachment) {\n    shop {\n      shopIdStr\n      name\n      image\n      url\n      __typename\n    }\n    list {\n      reviewIdStr\n      message\n      productRating\n      reviewCreateTime\n      reviewCreateTimestamp\n      isReportable\n      isAnonymous\n      imageAttachments {\n        attachmentId\n        imageUrl\n        imageThumbnailUrl\n        __typename\n      }\n      reviewResponse {\n        message\n        createTime\n        __typename\n      }\n      likeDislike {\n        totalLike\n        likeStatus\n        __typename\n      }\n      user {\n        userId\n        fullName\n        image\n        url\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n"
            }
        ]';
    
        $ch = curl_init('https://gql.tokopedia.com/graphql/ProductReviewListQueryV2');
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Origin: https://www.tokopedia.com',
            'x-tkpd-lite-service: zeus',
            'x-device: desktop',
            'x-source: tokopedia-lite',
            'x-tkpd-akamai: pdpGetLayout',
            'x-tkpd-lite-service: zeus',
            'x-version: 41639d1',
        ));
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    
        $resp = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($resp,true);
  }

  public function getpdp2(){
        $pdpSession = addslashes($_POST['pdp']);
        $id_prod = $_POST['id_prod'];
        
        $payload = '[
            {
                "operationName": "PDPGetDataP2",
                "variables": {
                    "affiliate": null,
                    "productID": "'.$id_prod.'",
                    "pdpSession": "'.$pdpSession.'",
                    "userLocation": {
                        "addressID": "0",
                        "districtID": "2274",
                        "postalCode": "",
                        "latlon": ""
                    }
                },
                "query": "query PDPGetDataP2($productID: String!, $pdpSession: String!, $deviceID: String, $userLocation: pdpUserLocation, $affiliate: pdpAffiliate) {\n  pdpGetData(productID: $productID, pdpSession: $pdpSession, deviceID: $deviceID, userLocation: $userLocation, affiliate: $affiliate) {\n    error {\n      Code\n      Message\n      DevMessage\n      __typename\n    }\n    callsError {\n      shopInfo {\n        Code\n        Message\n        __typename\n      }\n      cartRedirection {\n        Code\n        Message\n        __typename\n      }\n      nearestWarehouse {\n        Code\n        Message\n        __typename\n      }\n      __typename\n    }\n    productView\n    wishlistCount\n    shopInfo {\n      shopTier\n      badgeURL\n      closedInfo {\n        closedNote\n        reason\n        detail {\n          openDate\n          __typename\n        }\n        __typename\n      }\n      isOpen\n      favoriteData {\n        totalFavorite\n        alreadyFavorited\n        __typename\n      }\n      activeProduct\n      createInfo {\n        epochShopCreated\n        __typename\n      }\n      shopAssets {\n        avatar\n        __typename\n      }\n      shopCore {\n        domain\n        shopID\n        name\n        shopScore\n        url\n        ownerID\n        __typename\n      }\n      shopLastActive\n      location\n      statusInfo {\n        statusMessage\n        shopStatus\n        isIdle\n        __typename\n      }\n      isAllowManage\n      isOwner\n      ownerInfo {\n        id\n        __typename\n      }\n      isCOD\n      shopType\n      tickerData {\n        title\n        message\n        color\n        link\n        action\n        actionLink\n        tickerType\n        actionBottomSheet {\n          title\n          message\n          reason\n          buttonText\n          buttonLink\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    merchantVoucher {\n      vouchers {\n        voucher_id\n        voucher_name\n        voucher_type {\n          voucher_type\n          identifier\n          __typename\n        }\n        voucher_code\n        amount {\n          amount\n          amount_type\n          amount_formatted\n          __typename\n        }\n        minimum_spend\n        valid_thru\n        tnc\n        banner {\n          desktop_url\n          mobile_url\n          __typename\n        }\n        status {\n          status\n          identifier\n          __typename\n        }\n        in_use_expiry\n        __typename\n      }\n      __typename\n    }\n    nearestWarehouse {\n      product_id\n      stock\n      stock_wording\n      price\n      warehouse_info {\n        warehouse_id\n        is_fulfillment\n        district_id\n        postal_code\n        geolocation\n        __typename\n      }\n      __typename\n    }\n    installmentRecommendation {\n      data {\n        term\n        mdr_value\n        mdr_type\n        interest_rate\n        minimum_amount\n        maximum_amount\n        monthly_price\n        os_monthly_price\n        partner_code\n        partner_name\n        partner_icon\n        subtitle\n        __typename\n      }\n      __typename\n    }\n    productWishlistQuery {\n      value\n      __typename\n    }\n    cartRedirection {\n      status\n      error_message\n      data {\n        product_id\n        config_name\n        hide_floating_button\n        available_buttons {\n          text\n          color\n          cart_type\n          onboarding_message\n          show_recommendation\n          __typename\n        }\n        unavailable_buttons\n        __typename\n      }\n      __typename\n    }\n    shopTopChatSpeed {\n      messageResponseTime\n      __typename\n    }\n    shopRatingsQuery {\n      ratingScore\n      __typename\n    }\n    shopPackSpeed {\n      speedFmt\n      hour\n      __typename\n    }\n    shopFeature {\n      IsGoApotik\n      __typename\n    }\n    ratesEstimate {\n      warehouseID\n      products\n      data {\n        destination\n        title\n        subtitle\n        courierLabel\n        eTAText\n        cheapestShippingPrice\n        errors {\n          code: Code\n          message: Message\n          devMessage: DevMessage\n          __typename\n        }\n        __typename\n      }\n      bottomsheet {\n        title\n        iconURL\n        subtitle\n        buttonCopy\n        __typename\n      }\n      __typename\n    }\n    restrictionInfo {\n      message\n      restrictionData {\n        productID\n        isEligible\n        action {\n          actionType\n          title\n          description\n          attributeName\n          badgeURL\n          buttonText\n          buttonLink\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    ticker {\n      tickerInfo {\n        productIDs\n        tickerData {\n          title\n          message\n          color\n          link\n          action\n          actionLink\n          tickerType\n          actionBottomSheet {\n            title\n            message\n            reason\n            buttonText\n            buttonLink\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n"
            }
        ]';
    
        $ch = curl_init('https://gql.tokopedia.com/graphql/PDPGetDataP2');
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Origin: https://www.tokopedia.com',
            'x-tkpd-lite-service: zeus',
            'x-device: desktop',
            'x-source: tokopedia-lite',
            'x-tkpd-akamai: pdpGetLayout',
            'x-tkpd-lite-service: zeus',
            'x-version: 41639d1',
        ));
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    
        $resp = curl_exec($ch);
        curl_close($ch);

        echo $resp;
  }

  public function simpan_data_produk(){
      $cr_data = $this->mo_res->getWhere('tb_link',array(
        'link' => $_POST['url']
      ));

      if($cr_data['row'] > 0){
        $d = $cr_data['data'][0];
        // update nama produk di tb_link
        $this->mo_res->update('tb_link',array(
          'nama_produk' => $_POST['nama_prod'],
          'id_toko' => $_POST['shop_id'],
        ),array(
          'link' => $_POST['url']
        ));

        // untuk update date di tb_data_link
        $cek_data_link = $this->mo_res->getWhere('tb_data_link',array(
          'id_link' => $d['id'],
          'updated_at like' => "%".date('Y-m-d')."%"
        ));

              $cek_data_link_sebelumnya = $this->mo_res->getWhere('tb_data_link',array(
                  'id_link' => $d['id'],
                  'created_at like' => "%".date('Y-m-d',strtotime(date('Y-m-d').' -1 days'))."%"
              ));
              
              $terjual_sebelumnya = @$cek_data_link_sebelumnya['data'][0]['total_terjual'];
              $terjual_sebelumnya = empty($terjual_sebelumnya)?0:$terjual_sebelumnya;

        if($cek_data_link['row'] > 0 ){
          $this->mo_res->update('tb_data_link',array(
            'harga' => $_POST['harga'],
            'stok' => !empty($_POST['status_stok']) && $_POST['status_stok'] == 'ACTIVE'?$_POST['stok']:0,
            'total_terjual' => $_POST['terjual'],
            'updated_at' => date('Y-m-d H:i:s'),
                      'terjual_sebelumnya' => $terjual_sebelumnya,
          ),array(
            'id_link' => $d['id'],
                      'created_at like' => "%".date('Y-m-d')."%"
          ));
        }else{
          $arr_in_data_link = array(
            'harga' => $_POST['harga'],
            'stok' => $_POST['stok'],
            'total_terjual' => $_POST['terjual'],
            'id_link' => $d['id'],
            'updated_at' => date('Y-m-d H:i:s'),
                      'terjual_sebelumnya' => $terjual_sebelumnya,
          );

          $this->mo_res->input('tb_data_link',$arr_in_data_link);
        }

              // data link
              // $this->mo_res->update('tb_link',array(
              //     'harga' => $_POST['harga'],
              //     'stok' => $_POST['stok'],
              //     'total_terjual' => $_POST['terjual'],
              //     'updated_at' => date('Y-m-d H:i:s'),
              // ),array(
              //     'id' => $d['id']
              // ));
      }
  }

  public function simpan_data_toko(){
      $cek_toko = $this->mo_res->getWhere('tb_toko',array(
        'id_shopee' => $_POST['shop_id'],
        'ecom' => 'tokopedia'
      ));

      if($cek_toko['row'] > 0){
        $this->mo_res->update('tb_toko',array(
          'nama' => $_POST['nama_toko'],
          'lokasi' => $_POST['asal'],
          'rating_star' => $_POST['rating_star'],
          'updated_at' => date('Y-m-d H:i:s'),
        ),array(
          'id_shopee' => $_POST['shop_id'],
          'ecom' => 'tokopedia'
        ));
      }else{
        $this->mo_res->input('tb_toko',array(
          'nama' => $_POST['nama_toko'],
          'lokasi' => $_POST['asal'],
          'rating_star' => $_POST['rating_star'],
          'updated_at' => date('Y-m-d H:i:s'),
          'id_shopee' => $_POST['shop_id'],
          'ecom' => 'tokopedia'
        ));
      }
  }
}