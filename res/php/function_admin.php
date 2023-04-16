<?php 

	require 'init.php';

	class User_Actions{

		public function loginUser($ip,$user,$fecha){
			global $database;

			$data = $database->insert('crs_user_login',[
				'ip_user'   => $ip,
				'user_name' => $user,
				'fecha'     => $fecha
			]);
			return $database->id();
		}

		public function getFacility(){
			global $database;

			$data = $database->select('crs_facility',[
				'id_facility',
				'image',
				'description'
			],[
				'active_at' => 1,
				'deleted_at' => Null
			]);
			return $data;
		}


		public function getSliders($hotel){
			global $database;

			$data = $database->select('crs_images_slider',[
				'id_slider',
				'image',
				'title',
				'subtitle',
				'orden',
				'active_at',
				'from_date',
				'to_date'
			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null
			]);
			return $data;

		} 

		public function getNews($hotel){
			global $database;

			$data = $database->select('crs_news',[
				'id_news',
				'imagen',
				'date_news',
				'title',
				'subtitle',
				'body',
				'footer',
				'active_at',
				'publication_from',
				'publication_to'
			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null
			]);
			return $data;

		}

		public function getTourism($hotel){
			global $database;

			$data = $database->select('crs_events',[
				'id_event',
				'imagen',
				'title',
				'subtitle',
				'event_from',
				'event_to',
				'active_at',
				'body',
				'lugar',
				'horario',
				'informacion_precio',
				'link',
				'url'
			],[
				'id_hotel'   => $hotel,
				'deleted_at' => Null
			]);
			return $data;

		}

		public function countBookingRoom($code){
			global $database;

			$data = $database->count('crs_bookings',[
				'id_room' => $code				
			]);
			return $data;			
		}

		public function insertBookingLog($hotel,$book,$estado,$user,$ahora,$mipc){
			global $database;

			$data = $database->insert('crs_bookings_log',[
				'id_hotel' => $hotel, 
				'id_book'  => $book,
				'user'     => $user,
				'action'   => $estado,
				'date'     => $ahora,
				'mipc'     => $mipc
			]);
			return $data;
		}

		public function updateBooking($hotel,$code,$book){
			global $database;

			$data = $database->update('crs_bookings',[
				'status' => $code
			],[
				'id_hotel' => $hotel,
				'booking_nro' => $book
			]);
			return $data->rowCount();
		}


		public function getHotelInfo($code){ // Informacion Hotel
			global $database;
			$data = $database->select('crs_hotels',[
				'id_hotel',
				'hotel_name', 
				'nit_hotel',
				'active_at',
				'movil',
				'email',
				'phone',
				'adress',
				'city',
				'land',
				'email_contact',
				'email_book',
				'min_price',
				'id_destination',
				'title_web',
				'img_portada',
				'check_in',
				'check_out',
				'tax_inc',
				'logo',
				'icono',
				'img_portada',
				'eslogan',
				'latitud',
				'longitud',
				'currency',
				'message_footer'
			],[
				/* 'active_at' => 1, */
				'deleted_at' => Null,
				'id_hotel' => $code
			],[
				'ORDER' => 'order_at'
			]);
			return $data;
		}
 
		public function getBookingStatus($hotel,$stat,$hoy){
			global $database;

			$data = $database->select('crs_bookings',[
				'[>]crs_rooms' => 'id_room',				
			],[
				'crs_bookings.id',
				'crs_bookings.in_date',
				'crs_bookings.out_date',
				'crs_bookings.children',
				'crs_bookings.adults',
				'crs_bookings.price',
				'crs_bookings.vlr_booking',
				'crs_bookings.tax_booking',
				'crs_bookings.days',
				'crs_bookings.comments',
				'crs_bookings.name',
				'crs_bookings.last_name',
				'crs_bookings.identify',
				'crs_bookings.email',
				'crs_bookings.phone',
				'crs_bookings.adress',
				'crs_bookings.city',
				'crs_bookings.id_land',
				'crs_bookings.booking_nro',
				'crs_bookings.date_book',
				'crs_bookings.status',
				'crs_bookings.abeas',
				'crs_bookings.qty_room',
				'crs_bookings.pay_type',
				'crs_bookings.id_payu',
				'crs_rooms.room_name'
			],[
				'crs_bookings.status'   => $stat,
				'crs_bookings.id_hotel' => $hotel,
				'crs_bookings.in_date[>=]' => $hoy
			]);
			return $data;
		}


		/* FIN FUNCIONES PROCESO ADMIN */
		public function getArticleInfo($code){
			global $database;

			$data = $database->select('crs_articles',[
				'id_article',
				'title',
				'subtitle',
				'body',
				'url',
				'footer'
			],[
				'id_article' => $code, 
				'active_at' => 1,
				'deleted_at' => Null
			]);
			return $data;
		}

		public function GetBookingInfo($hotel){
			global $database;

			$data = $database->select('crs_hotels',[
				'reservation_terms',
				'confirmation_reservation',
				'title_confirmation',
				'email_book',
				'condition_booking',
				'check_in',
				'check_out',
				'web',
				'sub_cancel_booking',
				'sub_confirm_booking',
				'message_cancel_booking',
				'message_confirm_booking',
				'sub_new_booking',
				'message_new_booking'
			],[
				'id_hotel' => $hotel
			]);
			return $data;
		}

		public function getRoomName($room){
			global $database;

			$data = $database->select('crs_rooms',[
				'room_name'
			],[
				'id_room' => $room
			]);
			return $data[0]['room_name'];
		}

		public function insertInfoPayuConfirmation($merchant_id, $state_pol, $risk, $response_code_pol, $reference_sale, $reference_pol, $sign, $extra1, $extra2, $payment_method, $payment_method_type, $installments_number, $value, $tax, $additional_value, $transaction_date, $currency, $email_buyer, $pse_bank, $description, $billing_address, $shipping_address, $phone, $office_phone, $administrative_fee, $administrative_fee_base, $administrative_fee_tax, $airline_code, $attempts, $bank_id, $billing_city, $billing_country, $customer_number, $date, $error_code_bank, $error_message_bank, $exchange_rate, $ip, $nickname_buyer, $nickname_seller, $payment_method_id, $payment_request_state, $response_message_pol, $shipping_city, $shipping_country, $transaction_id){
			global $database;

			$data = $database->insert('crs_payu_confirmation',[
				'merchant_id'             => $merchant_id,
				'state_pol'               => $state_pol,
				'risk'                    => $risk,
				'response_code_pol'       => $response_code_pol,
				'reference_sale'          => $reference_sale,
				'reference_pol'           => $reference_pol,
				'sign'                    => $sign,
				'extra1'                  => $extra1,
				'extra2'                  => $extra2,
				'payment_method'          => $payment_method,
				'payment_method_type'     => $payment_method_type,
				'installments_number'     => $installments_number,
				'value'                   => $value,
				'tax'                     => $tax,
				'additional_value'        => $additional_value,
				'transaction_date'        => $transaction_date,
				'currency'                => $currency,
				'email_buyer'             => $email_buyer,
				'pse_bank'                => $pse_bank,
				'description'             => $description,
				'billing_address'         => $billing_address,
				'shipping_address'        => $shipping_address,
				'phone'                   => $phone,
				'office_phone'            => $office_phone,
				'administrative_fee'      => $administrative_fee,
				'administrative_fee_base' => $administrative_fee_base,
				'administrative_fee_tax'  => $administrative_fee_tax,
				'airline_code'            => $airline_code,
				'attempts'                => $attempts,
				'bank_id'                 => $bank_id,
				'billing_city'            => $billing_city,
				'billing_country'         => $billing_country,
				'customer_number'         => $customer_number,
				'date'                    => $date,
				'error_code_bank'         => $error_code_bank,
				'error_message_bank'      => $error_message_bank,
				'exchange_rate'           => $exchange_rate,
				'ip'                      => $ip,
				'nickname_buyer'          => $nickname_buyer,
				'nickname_seller'         => $nickname_seller,
				'payment_method_id'       => $payment_method_id,
				'payment_request_state'   => $payment_request_state,
				'response_message_pol'    => $response_message_pol,
				'shipping_city'           => $shipping_city,
				'shipping_country'        => $shipping_country,
				'transaction_id'          => $transaction_id,
				'created_at'              => time()
			]);
			return $database->id();
		}

		public function getMoreRoom($hotel,$room){ //Habitaciones Hotel
			global $database;

			$data = $database->select('crs_rooms',[
				'id_room',
				'room_name',
				'sub_text',
				'price',
				'image',
				'pax_max',
				'pax_min',
				'inventory',
				'details'
			],[
				'active_at' => 1,
				'id_hotel' => $hotel,
				'id_room[!]' => $room,
				'deleted_at' => Null
			],[
				'ORDER' => ['orden','ASC']
			]);
			return $data;
		}


		public function getImagesRoom($code){
			global $database;

			$data = $database->select('crs_images_room',[
				'image',
				'description'
			],[
				'id_room' => $code,
				'active_at' => 1,
				'deleted_at' => Null,
				'ORDER' => 'orden'
			]);
			return $data;
		}


		public function menuFooter($code){ // Menu Pie de Pagina
			global $database;

			$data = $database->select('crs_menu',[
				'id_menu',
				'description',
				'link',
				'icon',
				'menu_id',
				'title',
				'new_window'
			],[
				'active_at' => 1,
				'menu_type'  => 2,
				'id_hotel' => $code,
				'deleted_at' => NUll
			],[
				'ORDER' => 'order_at'
			]);
			return $data;
		}

		public function getRoomInfo($code){ //Habitaciones Hotel
			global $database;

			$data = $database->select('crs_rooms',[
				'id_room',
				'room_name',
				'sub_text',
				'price',
				'image',
				'pax_max',
				'pax_min',
				'inventory',
				'beds',
				'details'
			],[
				'active_at' => 1,
				'id_room' => $code,
				'deleted_at' => Null
			],[
				'ORDER' => ['orden','ASC']
			]);
			return $data;
		}

		public function getInfoPayuAdmin($code){
			global $database;

			$data = $database->select('crs_payu',[
				'transaction_state',
				'reference_pol',
				'transaction_id',
				'reference_code',
				'cus',
				'pse_bank',
				'currency',
				'extra1',
				'lap_payment',
				'tx_value'
			],[
				'id_payu' => $code
			]);
			return $data;
		}

		public function getInfoPayu($code){
			global $database;

			$data = $database->select('crs_payu',[
				'transaction_state',
				'lap_transaction',
				'message_transaction',
				'reference_code',
				'description',
				'transaction_id',
				'reference_pol',
				'currency',
				'extra1',
				'pol_transaction',
				'pol_response',
				'lap_response',
				'lap_payment',
				'lap_payment_type',
				'cus',
				'pse_bank',
				'lap_payment',
				'tx_value',
				'tx_tax'
			],[
				'id_payu' => $code
			]);
			return $data;
		}

		public function insertInfoPayu($idhotel,$transactionState,$lapTransactionState,$messagepay,$referenceCode,$reference_pol,$transactionId,$description,$trazabilityCode,$cus,$orderLanguage,$extra1,$extra2,$extra3,$polTransactionState,$signature,$polResponseCode,$lapResponseCode,$risk,$lapPaymentMethod,$polPaymentMethodType,$lapPaymentMethodType,$installmentsNumber,$tx_value,$tx_tax,$currency,$lng,$pseCycle,$pseBank,$pseReference1,$pseReference2,$pseReference3,$authorizationCode){
			global $database;

			$data = $database->insert('crs_payu',[
				'id_hotel'            => $idhotel,
				'transaction_state'   => $transactionState,
				'lap_transaction'     => $lapTransactionState,
				'message_transaction' => $messagepay,
				'reference_code'      => $referenceCode,
				'reference_pol'       => $reference_pol,
				'transaction_id'      => $transactionId,
				'description'         => $description,
				'trazabilitycode'     => $trazabilityCode,
				'cus'                 => $cus,
				'orderlanguage'       => $orderLanguage,
				'extra1'              => $extra1,
				'extra2'              => $extra2,
				'extra3'              => $extra3,
				'pol_transaction'     => $polTransactionState,
				'signature'           => $signature,
				'pol_response'        => $polResponseCode,
				'lap_response'        => $lapResponseCode,
				'risk'                => $risk,
				'lap_payment'         => $lapPaymentMethod,
				'pol_payment_type'    => $polPaymentMethodType,
				'lap_payment_type'    => $lapPaymentMethodType,
				'installments'        => $installmentsNumber,
				'tx_value'            => $tx_value,
				'tx_tax'              => $tx_tax,
				'currency'            => $currency,
				'lng'                 => $lng,
				'pse_cycle'           => $pseCycle,
				'pse_bank'            => $pseBank,
				'pse_reference1'      => $pseReference1,
				'pse_reference2'      => $pseReference2,
				'pse_reference3'      => $pseReference3,
				'autorization'        => $authorizationCode
		]);
			return $database->id();
		}

		public function getCantidadImagenes($code){
			global $database;

			$data = $database->count('crs_images_gallery',[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_hotel' => $code				
			]);
			return $data;
		}

		public function getGallery($hotel){
			global $database;
			$data = $database->select('crs_images_gallery',[
				'id_image',
				'imagen',
				'description_image',
				'title_image',
				'subtitle_image',
				'link_image',
				'id_gallery',
				'active_at'
			],[
				'deleted_at' => Null,
				'id_hotel' => $hotel
			]);
			return $data;
		}

		public function getAboutHotel($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'hotel_name',
				'hotel_title',
				'hotel_subtitle',
				'hotel_about', 
				'currency',
				'max_adults',
				'max_babys'

			],[
				'id_hotel' => $code
			]);
			return $data;
		}

		public function getNameLand($code){
			global $database;

			$data = $database->select('crs_lands',[
				'name_land'
			],[
				'id_land' => $code
			]);
			return $data[0]['name_land'];
		}

		public function getLands(){
			global $database;

			$data = $database->select('crs_lands',[
				'id_land',
				'iso',
				'name_land'
			],[
				'ORDER' => 'name_land'
			]);
			return $data;
		}

		public function insertNumberBookingHotel($code, $nro){
			global $database;

			$data = $database->update('crs_hotels',[
				'id_book' =>  $nro
			],[
				'id_hotel' => $code
			]);
			return $data->rowCount();
		}

		public function getNumberBookingHotel($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'id_book'
			],[
				'id_hotel' => $code
			]);
			return $data[0]['id_book'];
		}

		public function getDataPayHotel($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'paypal_email',
				'currency',
				'tax',
				'tax_inc',
				'id_payu',
				'id_mercant',
				'api_key',
				'type_money',
				'test',
				'url_confirm_payu',
				'url_response_payu'
			],[
				'id_hotel' => $code
			]);
			return $data;
		}

		public function getTaxHotel($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'tax_inc',
				'tax'
			],[
				'id_hotel' => $code
			]);
			return $data;
		}

		public function getHoteles($code){ // Hoteles
			global $database;
			$data = $database->select('crs_hotels',[
				'id_hotel',
				'hotel_name',
				'movil',
				'email',
				'phone',
				'adress',
				'min_price',
				'currency',
				'id_destination',
				'img_portada',
				'tax_inc'
			],[
				'active_at' => 1,
				'id_hotel' => $code,
				'deleted_at' => Null,
			],[
				'ORDER' => 'order_at'
			]);
			return $data;
		}

		public function getRoom($code){ //Habitaciones Hotel
			global $database;

			$data = $database->select('crs_rooms',[
				'id_room',
				'room_name',
				'sub_text',
				'price',
				'image',
				'pax_max',
				'pax_min',
				'inventory',
				'details',
			],[
				'active_at' => 1,
				'id_hotel' => $code,
				'deleted_at' => Null
			],[
				'ORDER' => ['orden','ASC']
			]);
			return $data;
		}

		public function socialMenu($hotel){ // Menu Redes Sociales
			global $database;

			$data = $database->select('crs_menu_social',[
				'id_menu_social',
				'description', 
				'mail',
				'users',
				'icon',
				'clase',
				'web',
				'active_at'
			],[
				'active_at' => '1',
				'id_hotel' => $hotel, 
				'deleted_at' => Null
			]);
			return $data;
		}

		public function getSliderHotel($hotel){
			global $database;

			$data = $database->select('crs_images_slider',[
				'image',
				'orden',
				'title',
				'subtitle',
				'button',
				'text_button',
				'link_button'
			],[
				'deleted_at' => Null,
				'active_at'  => 1,
				'id_hotel' => $hotel
			],[
				'ORDER' => 'orden'
			]);
			return $data;
		}

		public function menuPrincipal($hotel){ // Menu Principal
			global $database;

			$data = $database->select('crs_menu',[
				'id_menu',
				'description',
				'icon',
				'link',
				'menu_id',
				'title',
				'clase',
				'new_window'
			],[
				'active_at' => 1,
				'menu_type' => 1,
				'id_hotel'  => $hotel,
				'menu_id'   => 0,
				"ORDER" => ['order_at' => "ASC"]
			]);
			return $data;
		}

		public function subMenuPrincipal($menu){ // Menu Principal
			global $database;

			$data = $database->select('crs_menu',[
				'id_menu',
				'description',
				'icon',
				'link',
				'menu_id',
				'title',
				'clase',
				'new_window'
			],[
				'active_at' => 1,
				'menu_type' => 1,
				'menu_id'   => $menu,
				"ORDER" => ['order_at' => 'DESC']
			]);
			return $data;
		}



  	// fina del funcion hotels // 

		public function updateBookingPayu($hotel,$book, $stat, $tax){
			global $database;

			$data = $database->update('crs_bookings',[
				'status'      => $stat,
				'tax_booking' => $tax
			],[
				'id_hotel' => $hotel,
				'booking_nro' => $book,
			]);
			return $data->rowCount();
		}

		public function getCityHotel($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'id_destination'
			],[
				'id_hotel' => $code
			]);
			return $data[0]['id_destination'];
		}

		public function insertBooking($fechain,$fechaout,$adultos,$ninos,$noches,$tarifa,$tipohabi,$canthabi,$idhotel,$nombres,$apellidos,$vlrestadia,$valtax,$identi,$mail,$phone,$adress,$city,$land,$comments,$abeas,$numbook,$ip,$fecha){

			global $database;

			$database->insert('crs_bookings',[
				'in_date'     => $fechain,
				'out_date'    => $fechaout,
				'adults'      => $adultos,
				'children'    => $ninos,
				'days'        => $noches,
				'price'       => $tarifa,
				'id_room'     => $tipohabi,
				'vlr_booking' => $vlrestadia,
				'tax_booking' => $valtax,
				'comments'    => $comments,
				'name'        => $nombres,
				'last_name'   => $apellidos,
				'identify'    => $identi,
				'email'       => $mail,
				'phone'       => $phone,
				'adress'      => $adress,
				'city'        => $city,
				'id_land'     => $land,
				'booking_nro' => $numbook, 
				'date_book'   => $fecha, 
				'abeas'       => $abeas,
				'user_ip'     => $ip, 
				'qty_room'    => $canthabi,
				'id_hotel'    => $idhotel
			]);
			return $database->id();
		}

		public function insertNumberBookingCompany($code, $nro){
			global $database;

			$data = $database->update('crs_company',[
				'id_book' =>  $nro
			],[
				'id_company' => $code
			]);
			return $data->rowCount();
		}


		public function getNameRoom($code){
			global $database;
			
			$data = $database->select('crs_rooms',[
				'room_name'
			],[
				'id_room' => $code
			]);
			return $data[0]['room_name'];
		}

		public function getDetailBooking($hotel,$code){
			global $database;

			$data = $database->select('crs_bookings',[
				'in_date',
				'out_date',
				'last_name',
				'name',
				'identify',
				'email',
				'phone',
				'city',
				'id_land',
				'adress',
				'city',
				'adults',
				'children',
				'days',
				'price',
				'vlr_booking',
				'tax_booking',
				'comments',
				'id_room',
				'id_hotel',
				'id_company',
				'date_book',
				'status',
				'qty_room'
			],[
				'booking_nro' => $code,
				'id_hotel' => $hotel
			]);
			return $data;
		}


		public function getNumberBookingCompany($code){
			global $database;

			$data = $database->select('crs_company',[
				'id_book'
			],[
				'id_company' => $code
			]);
			return $data[0]['id_book'];
		}

		public function getDataPayCia($code){
			global $database;

			$data = $database->select('crs_company',[
				'paypal_email',
				'currency',
				'tax',
				'tax_inc',
				'id_payu',
				'id_mercant',
				'api_key',
				'type_money',
				'test',
				'url_confirm_payu',
				'url_response_payu'
			],[
				'id_company' => $code
			]);
			return $data;
		}

		public function getTypePay($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'pay_company'
			],[
				'id_company' => $code
			]);
			return $data[0]['pay_company'];
		}

		public function getFacilitySample(){
			global $database;

			$data = $database->select('crs_facility',[
				'id_facility',
				'image',
				'description'
			],[
				'active_at' => 1,
				'deleted_at' => Null,
				'LIMIT' => 4
			]);
			return $data;
		}


		public function getDestinoInfo($code, $dest){
			global $database;

			$data = $database->select('crs_destination',[
				'id_destino',
				'id_company',
				'descripcion_destino',
				'image',
				'slogan',
				'text',
				'subtext',
				'latitude',
				'longitude'
			],[
				'id_company' => $code,
				'id_destino' => $dest,
				'deleted_at' => Null,
				'active_at' => 1
			]);
			return $data;
		}

		public function mailCompany($code){ // Datos Compañia 
			global $database;

			$data = $database->select('crs_company',[
				'email',
				'logo',
				'phone',
				'movil',
				'adress',
				'city',
				'land',
				'email_contact',
				'web'
			],[
				'id_company' => $code,
				'active_at'  => 1,
				'deleted_at' => Null
			]);
			return $data;
		}


		public function getCantidadImagenesHotel($code){
			global $database;

			$data = $database->count('crs_images_gallery',[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_hotel' => $code				
			]);
			return $data;
		}


		public function getCantidadActividadess($code){
			global $database;

			$data = $database->count('crs_tourism',[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_company' => $code				
			]);
			return $data;
		}

		public function getCantidadHoteles($code){
			global $database;

			$count = $database->count('crs_hotels',[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_company' => $code
			]);
			return $count;
		}

		public function getBestActivities($can,$regis,$code){
			global $database;

			$data = $database->select('crs_tourism',[
				'id_activity',
				'descripcion_actividad',
				'text',
				'subtext',
				'adress',
				'city',
				'phone',
				'movil',
				'web',
				'imagen',
				'price',
				'id_destination'
			],[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_company' => $code,
				"LIMIT" => [$can, $regis]
			],[
				'ORDER' => 'descripcion_actividad'
			]);
			return $data;
		}

		public function getActivities($code){
			global $database;

			$data = $database->select('crs_tourism',[
				'id_activity',
				'descripcion_actividad',
				'text',
				'subtext',
				'adress',
				'city',
				'phone',
				'movil',
				'web',
				'imagen',
				'price',
				'id_destination'
			],[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_company' => $code
			],[
				'ORDER' => 'descripcion_actividad'
			]);
			return $data;
		}

		public function getActivitiesDestination($regis,$code){
			global $database;

			$data = $database->select('crs_tourism',[
				'id_activity',
				'descripcion_actividad',
				'text',
				'subtext',
				'adress',
				'city',
				'phone',
				'movil',
				'web',
				'imagen',
				'price',
				'id_destination'
			],[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_company' => $code,
				'id_destination' => $regis
			],[
				'ORDER' => 'descripcion_actividad'
			]);
			return $data;
		}

		public function getDestinos($code){
			global $database;

			$data = $database->select('crs_destination',[
				'id_destino',
				'descripcion_destino',
				'image',
				'slogan',
				'text',
				'subtext',
				'maps'
			],[
				'active_at' => 1,
				'id_company' => $code
			]);
			return $data;
		}

		public function getCityName($code){
			global $database;

			$data = $database->select('crs_destination',[
				'descripcion_destino'
			],[
				'id_destino' => $code
			]);
			return $data[0]['descripcion_destino'];
		}

		public function getSlider($cia){
			global $database;

			$data = $database->select('crs_images_slider',[
				'image',
				'orden',
				'title',
				'subtitle',
				'button',
				'text_button',
				'link_button'
			],[
				'deleted_at' => Null,
				'active_at'  => 1,
				'id_company' => $cia
			],[
				'ORDER' => 'orden'
			]);
			return $data;
		}

		public function getRateRoom($code,$fechaini, $fechafin){ // Selecciona tarifa por Rango de Fechas 
			global $database;

			$data = $database->query("select * from crs_rates_value WHERE crs_rates_value.id_room = '$code' AND crs_rates_value.date_num BETWEEN '$fechaini' AND '$fechafin' ")->fetchAll();
			return $data;
		}

		public function getDisponibilidadRoom($room,$fecha){
			global $database;

			$count = $database->count('crs_bookings',[
				'id_room' => $room,
				'in_date' => $fecha
			]);
			return $count;

		}

		public function getHotelName($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'hotel_name'
			],[
				'id_hotel' => $code
			]);
			return $data[0]['hotel_name'];
		}


		public function getTaxCompany($code){ // Tarifa Impuestos de la compañia
			global $database;

			$data = $database->select('crs_company',[
				'tax_inc'
			],[
				'id_company' => $code
			]);
			return $data[0]['tax_inc'];
		}


		public function getTypeRoom($hotel,$room){ //Habitacion Seleccionada
			global $database;

			$data = $database->select('crs_rooms',[
				'id_room',
				'room_name',
				'image'
			],[
				'id_hotel' => $hotel,
				'id_room' => $room
			]);
			return $data;
		}

		public function getFacilityRoom($code){ // Facilidades de la Habitacion Seleccionada
			global $database;

			$data = $database->select('crs_facility_room',[
				"[>]crs_facility" => "id_facility"
			],[
				'crs_facility_room.id',
				'crs_facility_room.id_facility',
				'crs_facility_room.id_room',
				'crs_facility.image',
				'crs_facility.description'
			],[
				'crs_facility_room.id_room' => $code,
				'crs_facility_room.deleted_at' => Null
			]);
			return $data;
		}

		public function getRoomHotel($code){ // Habtaciones del Hotel Seleccionado
			global $database;

			$data = $database->select('crs_rooms',[
				'id_room',
				'room_name',
				'sub_text',
				'orden',
				'image',
				'pax_max',
				'pax_min',
				'beds',
				'adults',
				'kids',
				'inventory',
				'details',
				'min_stay',
				'price'
			],[
				'active_at' => 1,
				'id_hotel' => $code
			]);
			return $data;
		}

		public function getHotelesFull($cia){ // Todos los Hoteles
			global $database;

			$data = $database->select('crs_hotels',[
				'id_hotel',
				'hotel_name',
				'movil',
				'email',
				'phone',
				'adress',
				'min_price',
				'currency',
				'id_destination',
				'img_portada',
				'tax_inc'
			],[
				'active_at' => 1,
				'id_company' => $cia,
				'deleted_at' => Null
			],[
				'ORDER' => 'order_at'
			]);
			return $data;
		}

		public function getTextHotel($code){ // Titulos del Hotel 
			global $database;

			$data = $database->select('crs_hotels',[
				'id_hotel',
				'hotel_name',
				'title_privacy',
				'privacy_policy',
				'condition_booking',
				'reservation_terms',
				'title_terms_use',
				'terms_use',
				'title_confirmation',
				'confirmation_reservation',
				'title_privacy',
				'check_in',
				'check_out'
			],[
				'id_hotel' => $code
			]);
			return $data;
		}


		public function getHotelsDestination($code,$cia){ // Hoteles por Destino
			global $database;

			$data = $database->select('crs_hotels',[
				'id_hotel',
				'hotel_name',
				'movil',
				'email',
				'phone',
				'adress',
				'min_price',
				'id_destination',
				'img_portada',
				'tax_inc'
			],[
				'active_at' => 1,
				'id_company' => $cia,
				'deleted_at' => Null,
				'id_destination' => $code
			],[
				'ORDER' => 'order_at'
			]);
			return $data;
		}


		public function cityDestination(){ // Ciudades de Destino
			global $database;

			$data = $database->select('crs_destination',[
				'id_destino',
				'descripcion_destino'
			],[
				'active_at' => 1,
				'deleted_at' => Null,
				'id_company' => ID_CIA
			],[
				'ORDER' => 'descripcion_destino'
			]);
			return $data;
		}

		public function mensageFooter(){ // Mensaje de Pie de Pagina
			global $database;

			$data = $database->select('crs_company',[
				'message_footer'
			],[
				'id_company' => ID_CIA
			]);
			return $data[0]['message_footer'];
		}

		public function getHotels($reg,$code,$cia){ // Hoteles Destacados
			global $database;

			$data = $database->select('crs_hotels',[
				'id_hotel',
				'hotel_name',
				'movil',
				'id_destination',
				'adress',
				'min_price',
				'img_portada'
			],[
				'active_at' => '1',
				'id_company' => $cia,
				'deleted_at' => Null,
				"LIMIT" => [$reg, $code]
			]);
			return $data;
		}

		public function menuTop(){ // Menu Top
			global $database;

			$data = $database->select('crs_menu_top',[
				'id_menu_top',
				'description',
				'icon',
				'link',
				'title',
				'new_window'
			],[
				'active_at' => 1,
				'id_company' => ID_CIA, 
				'deleted_at' => Null
			],[
				"ORDER" => ["order_at" => "DES"]
			]);
			return $data;
		}

		public function Company($code){ // Datos Compañia 
			global $database;

			$data = $database->select('crs_company',[
				'id_company',
				'name_company',
				'nit_company',
				'email',
				'email_contact',
				'email_book',
				'logo',
				'phone',
				'movil',
				'adress',
				'city',
				'land',
				'api_key',
				'api_login',
				'key_public',
				'title_web',
				'test',
				'web',
				'latitud',
				'longitud'
			],[
				'id_company' => $code,
				'active_at' => 1,
				'deleted_at' => Null
			]);
			return $data;
		}

		public function Login($username_email, $pass){
			global $database;

			$data = $database->select("users",[
					"password"
				],[
				"OR"=>[
					"user_name" => $username_email,
					"email"     =>$username_email
				]
			]);

			$password_db =  $data[0]["password"];

			if(password_verify($pass,$password_db)){
				return true;
			}else{
				return false;
			}
		}

		public function getProfile($session){
			global $database;

			$user = $database->select("users", [
				'user_id'
			],[
				'OR' =>[
					'user_name' => $session,
					'email'     => $session
				]
			]);

			return $user;
		}

		public function checkExistance($user_name, $email){
			global $database;

			$users = $database->count("users", [
				'OR' =>[
					'user_name' => $email,
					'email'     => $email
				]
			]);

			return $users;
		}

		public function register($name, $last_name, $user_name, $email, $pass){
			global $database;

			if($this->checkExistance($user_name,$email)==0){
					$register    = $database -> insert('users',[
					'name'       => htmlentities($name),
					'last_name'  => htmlentities($last_name),
					'user_name'  => htmlentities($user_name),
					'email'      => htmlentities($email),
					'password'   => password_hash($pass, PASSWORD_BCRYPT),
					'created_at' => time()
				]);
				return $database->id();
			}else {
				return 0;
			}
		}

		public function getPosts(){
			global $database;
			$posts = $database->select('posts',[
				'post_id',
				'name',
				'img_post',
				'created_at'
			],[
				'ORDER' => ['posts.post_id' => 'DESC']
			]);
			return $posts ;
		}

		public function getRecentPosts(){
			global $database;

			$posts = $database->select('posts',[
				'post_id',
				'name',
				'img_post',
				'created_at'
			],[
				'ORDER' => ['posts.post_id' => 'DESC'],
				'LIMIT' => '8'
			]);
			return $posts ;
		}

		public function getPostInfo($post_id){
			global $database;

			$posts = $database->select('posts',[
				'[>]categories' => ['category_id' => 'category_id'],
				'[>]admins' => ['admin_id' => 'admin_id'],
			],[
				'posts.name',
				'posts.body',
				'posts.img_post',
				'posts.created_at',
				'categories.category',
				'admins.user_name'

			],[
				'posts.post_id' => $post_id
			]);
			return $posts ;			
		}
		
		public function getGalleryOld(){
			global $database;
			$gallery = $database->select('gallery',[
				'gallery_id',
				'img_gallery',
				'description',
				'created_at',
				'admin_id' 
			],
			[
				'active_at' => '1',
				'ORDER' => ['gallery.gallery_id' => 'DESC']
			]);
			return $gallery ;
		}

		public function getGalleryHotel($can,$regis,$code){
			global $database;

			$data = $database->select('crs_images_gallery',[
				'id_image',
				'id_gallery',
				'imagen',
				'description_image',
				'title_image',
				'subtitle_image',
				'link_image'
			],[	
				'id_hotel'   => $code, 
				'active_at'  => 1,
				'deleted_at' => Null,
				"LIMIT"      => [$can, $regis]
			],[
				'ORDER' => ['id_gallery' => 'ASC']
			]);
			return $data ;
		}


		public function markAsFavorite($post_id, $user_id){

			global$database;

			$database->insert('favorites',[
				'user_id' => $user_id,
				'post_id' => $post_id
			]);

				return $database->id() ;			
		}



		public function getMyFavorites($user_id){
			global $database;

			$posts = $database->select('favorites',[
				'[>]posts' => ['post_id'=>'post_id'
			]
			],[
				'posts.post_id',
				'posts.name',
				'posts.img_post',
				'posts.created_at',
				'favorites.favorite_id'
			],[
				'favorites.user_id' => $user_id,
				'ORDER' => ['favorites.favorite_id' => 'DESC']
			]);
			return $posts ;			
		}

		public function checkFavorites($user_id,$post_id){
			global $database;

			$users = $database->count("favorites", [
				'AND' =>[
					'post_id' => $post_id,
					'user_id' => $user_id
				]
			]);

			return $users;
		}

	}

	class Booking_Actions{

		public function updateRateToday($newval, $min, $max, $disp, $idrate){
			global $database;

			$data = $database->update('crs_rates_value',[
				'value'    => $newval,
				'min_pax'  => $min,
				'max_pax'  => $max,
				'inv_room' => $disp,
				'updated_at'	=> time()
			],[
				'id' => $idrate
			]);
			return $data;
		}

		public function updateRateDay($newval, $esta, $min, $max, $disp, $dia, $idroom, $hotel){
			global $database;

			$data = $database->update('crs_rates_value',[
				'value'    => $newval, 
				'min_stay' => $esta,
				'min_pax'  => $min, 
				'max_pax'  => $max, 
				'inv_room' => $disp,
				'updated_at'	=> time()
			],[
				'date_book' => $dia, 
				'id_room'   => $idroom
			]);
			return $data->rowCount();
		}

		public function insertRateDay($idhotel,$newval,$idroom,$xdesde,$esta,$min,$max,$disp,$dia){
			global $database;

			$data = $database->insert('crs_rates_value',[
					'id_hotel'  => $idhotel,
					'value'     => $newval,
					'id_room'   => $idroom,
					'date_num'  => $xdesde,
					'min_stay'  => $esta,
					'min_pax'   => $min,
					'max_pax'   => $max,
					'inv_room'  => $disp,
					'date_book' => $dia, 
					'created_at' => time()
			]);
			return $database->id();
		}

	}

	class Admin_Actions{

		public function insertEvents($idhotel,$title,$subtitle,$imagen,$from,$to,$lugar,$horario,$precio,$body,$link,$url){
			global $database;

			$data = $database->insert('crs_events',[
				'id_hotel'           => $idhotel,
				'title'              => $title, 
				'subtitle'           => $subtitle,
				'imagen'             => $imagen,
				'event_from'         => $from,
				'event_to'           => $to,
				'body'               => $body, 
				'lugar'              => $lugar,
				'horario'            => $horario,
				'informacion_precio' => $precio,
				'link'               => $link,
				'url'                => $url,
				'active_at'          => 1,
				'created_at'         => time()
			]);
			return $database->id();
		}


		public function lockHotel($hotel,$code){
			global $database;

			$data = $database->update('crs_hotels',[
				'active_at' => $code
			],[
				'id_hotel' => $hotel
			]);
			return $data->rowCount();
		}


		public function getInfoCompany($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'id_hotel',
				'ower_hotel',
				'hotel_name',
				'title_web',
				'nit_hotel',
				'hotel_title',
				'hotel_subtitle',
				'hotel_about',
				'email',
				'icono',
				'logo',
				'img_portada',
				'eslogan',
				'sistem_base',
				'phone',
				'movil',
				'adress',
				'city',
				'land',
				'rnt',
				'email_contact',
				'web',
				'latitud', 
				'longitud',
				'color_menu',
				'font_menu',
				'color_footer',
				'font_footer',
				'color_card',
				'font_card',
				'color_fondo',
				'template',
				'active_at'
			],[
				'id_hotel' => $code 
			]);
			return $data;
		}


		public function getLands(){
			global $database;

			$data = $database->select('crs_lands',[
				'id_land',
				'iso',
				'name_land'
			],[
				'ORDER' => 'name_land'
			]);
			return $data;
		}

		public function getArticleInfo($code){
			global $database;

			$data = $database->select('crs_articles',[
				'title',
				'subtitle',
				'body',
				'url',
				'footer'
			],[
				'id_article' => $code, 
			]);
			return $data;
		}

		public function insertGalleryRoom($room,$hotel,$image){
			global $database;

			$data = $database->insert('crs_images_room',[
				'id_hotel'   => $hotel,
				'id_room'    => $room,
				'image'      => $image,
				'active_at'  => 1,
				'created_at' => time()
			]);
			return $database->id();
		}

		public function getImagesGalleryRoom($code){ // Facilidades de la Habitacion Seleccionada
			global $database;
			$data = $database->select('crs_images_room',[
				'id',
				'id_room',
				'image',
				'active_at',
				'description'
			],[
				'id_room' => $code,
				'deleted_at' => Null
			]);
			// echo print_r($data);
			return $data;
		}

		public function getGallery($hotel){
			global $database;
			$data = $database->select('crs_images_gallery',[
				'id_image',
				'imagen',
				'description_image',
				'title_image',
				'subtitle_image',
				'link_image',
				'id_gallery',
				'active_at'
			],[
				'deleted_at' => Null,
				'id_hotel' => $hotel
			]);
			return $data;
		}

		public function insertArticle($idhotel, $title, $subtitle, $body, $footer,$url){
			global $database;

			$data = $database->insert('crs_articles',[
				'id_hotel'   => $idhotel,
				'title'      => $title, 
				'subtitle'   => $subtitle,
				'body'       => $body, 
				'footer'     => $footer,
				'url'        => $url,
				'active_at'  => 1,
				'created_at' => time()
			]);
			return $database->id();
		}

		public function updateArticle($idarticle, $idhotel, $title, $subtitle, $body, $footer){
			global $database;

			$data = $database->update('crs_articles',[
				'id_hotel'   => $idhotel,
				'title'      => $title, 
				'subtitle'   => $subtitle,
				'body'       => $body, 
				'footer'     => $footer,
				'updated_at' => time()
			],[
				'id_article' => $idarticle
			]);
			return $database->id();
		}

		public function updateImageSlider($id, $idhotel, $title, $subtitle){
			global $database;

			$data = $database->update('crs_images_slider',[
				'title'      => $title, 
				'subtitle'   => $subtitle,
				'updated_at' => time()
			],[
				'id_slider' => $id
			]);
			return $database->id();
		}

		public function getArticles($hotel){
			global $database;

			$data = $database->select('crs_articles',[
				'id_article',
				'id_hotel',
				'title',
				'subtitle',
				'body',
				'footer',
				'url',
				'publication_from',
				'publication_to',
				'active_at'
			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null
			]);
			return $data;
		}

		public function getEvents($hotel){
			global $database;

			$data = $database->select('crs_events',[
				'id_event',
				'id_hotel',
				'imagen',
				'title',
				'subtitle',
				'event_from',
				'event_to',
				'active_at'
			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null
			]);
			return $data;
		}



		public function updateSocial($idhotel,$id,$descripcion,$icono,$link,$usuario){
			global $database;

			$data = $database->update('crs_menu_social',[
				'description' => $descripcion,
				'icon'        => $icono,
				'web'         => $link,
				'users'         => $usuario,
				'updated_at'  => time()
			],[
				'id_menu_social' => $id
			]);
			return $data->rowCount();
		}

		public function socialMenu($hotel){ // Menu Redes Sociales
			global $database;

			$data = $database->select('crs_menu_social',[
				'id_menu_social',
				'description', 
				'mail',
				'users',
				'icon',
				'clase',
				'web',
				'active_at'
			],[
				'id_hotel' => $hotel, 
				'deleted_at' => Null
			]);
			return $data;
		}


		public function insertSocial($idhotel,$descripcion,$icono,$link,$usuario){
			global $database;

			$data = $database->insert('crs_menu_social',[
				'id_hotel'     => $idhotel,
				'description' => $descripcion,
				'icon'        => $icono,
				'web'         => $link,
				'users'         => $usuario,
				'active_at'   => 1,
				'created_at'  => time()
			]);
			return $database->id();
		}

		public function deleteSocial($code){
			global $database;

			$data = $database->update('crs_menu_social',[
				'deleted_at' => time()
			],[
				'id_menu_social' => $code
			]);
			return $data->rowCount();
		}

		public function deleteArticle($code){
			global $database;

			$data = $database->update('crs_articles',[
				'deleted_at' => time()
			],[
				'id_article' => $code
			]);
			return $data->rowCount();
		}

		public function deleteEvent($code){
			global $database;

			$data = $database->update('crs_events',[
				'deleted_at' => time()
			],[
				'id_event' => $code
			]);
			return $data->rowCount();
		}

		public function deleteNews($code){
			global $database;

			$data = $database->update('crs_news',[
				'deleted_at' => time()
			],[
				'id_news' => $code
			]);
			return $data->rowCount();
		}

		public function deleteFavoriteRoom($code){
			global $database;

			$update = $database->update("crs_facility_room", [
				'deleted_at' => time()
			],[
				"id" => $code
			]);
			return $update->rowCount();			
		}

		public function deleteCategory($category_id){
			global $database;

			$delete = $database->delete("categories", [
				"category_id" => $category_id
			]);
			return $delete->rowCount();
		}

		public function deleteUser($user){
			global $database;

			$data = $database->update('crs_users',[
				'deleted_at' => time()
			],[
				'id_user' => $user
			]);
			return $data;
		}

		public function deleteRates($idroom){
			global $database;

			$data = $database->update('crs_rates_value',[
				'deleted_at' => time()
			],[
				'id_room' => $idroom
			]);
			return $data;
		}

		public function deleteRoom($idroom){
			global $database;

			$data = $database->update('crs_rooms',[
				'deleted_at' => time()
			],[
				'id_room' => $idroom
			]);
			return $data;
		}

		public function deleteImage($code){
			global $database;

			$data = $database->update('crs_images_gallery',[
				'deleted_at' => time()
			],[
				'id_image' => $code
			]);
			return $data->rowCount();
		}

		public function deleteMenu($code){
			global $database;

			$data = $database->update('crs_menu',[
				'deleted_at' => time()
			],[
				'id_menu' => $code
			]);
			return $data->rowCount();
		}

		public function deleteImageSlider($code){
			global $database;

			$data = $database->update('crs_images_slider',[
				'deleted_at' => time()
			],[
				'id_slider' => $code
			]);
			return $data->rowCount();
		}


		public function deleteImageRoom($code){
			global $database;

			$data = $database->update('crs_images_room',[
				'deleted_at' => time()
			],[
				'id' => $code
			]);
			return $data->rowCount();
		}


		public function insertFacilityRoom($hotel, $room, $facility){
			global $database;

			$data = $database->insert('crs_facility_room',[
				'id_room'     => $room,
				'id_hotel'    => $hotel,
				'id_facility' => $facility,
				'created_at'  => time()
			]);
			return $database->id();
		}

		public function getFacilityAddRoom($room){
			global $database;

			$data = $database->select('crs_facility',[
				"[>]crs_facility" => "id_facility"
			],[
				'id_facility',
				'image',
				'description'
			],[
				'crs_facility_room.id_room' => $room
			]);
			return $data;
		}

		public function getFacilityRoomAdmin($code){ // Facilidades de la Habitacion Seleccionada
			global $database;

			$data = $database->select('crs_facility_room',[
				"[>]crs_facility" => "id_facility"
			],[
				'crs_facility.image',
				'crs_facility.description'			
			],[
				'crs_facility_room.id_room' => $code
			]);
			return $data;
		}


		public function saveRooms($habitacion, $descripcion, $orden, $maxcap, $mincap, $idhotel, $disponible, $detalle,$adultos, $ninos,$minstay, $tarifa, $imagen,$url,$beds){
			global $database;

			$data = $database->insert('crs_rooms',[
				'room_name' => $habitacion,
				'sub_text'  => $descripcion,
				'orden'     => $orden,
				'price'     => $tarifa,
				'image'     => $imagen,
				'pax_max'   => $maxcap,
				'pax_min'   => $mincap,
				'adults'    => $adultos,
				'kids'      => $ninos,
				'beds'      => $beds,
				'id_hotel'  => $idhotel,
				'inventory' => $disponible,
				'details'   => $detalle,
				'url'   => $url,
				'active_at'    => 1, 
				'min_stay'  => $minstay,
				'created_at'  => time()
			]);
			return $database->id();
		}

		public function updateRooms($id, $detalle, $hotel, $habit, $subtext, $dispo, $maxca, $minca, $adult, $minstay, $ninos, $orden, $tarifa){
			global $database;

			$data = $database->update('crs_rooms',[				
				'room_name'  => $habit,
				'sub_text'   => $subtext,
				'orden'      => $orden,
				'price'      => $tarifa,
				'pax_max'    => $maxca,
				'pax_min'    => $minca,
				'adults'     => $adult,
				'kids'       => $ninos,
				'inventory'  => $dispo,
				'details'    => $detalle,
				'min_stay'   => $minstay,
				'price'      => $tarifa,
				'updated_at' => time()
			],[
				'id_room' => $id
			]);
			return $data->rowCount();
		}


		public function saveNews($idhotel, $name_img, $hoy, $titulo, $descripcion, $body, $footer, $url){
			global $database;

			$data = $database->insert('crs_news',[
				'id_hotel'   => $idhotel,
				'imagen'     => $name_img,
				'date_news'  => $hoy,
				'title'      => $titulo,
				'subtitle'   => $descripcion,
				'body'       => $body,
				'footer'     => $footer,
				'url'        => $url,
				'active_at'  => 2,
				'created_at' => time()
			]);
			return $database->id();
		}

		public function saveMenu($hotel, $idmenu, $descripcion, $link, $icono, $titulo, $orden, $menuid,$window){
			global $database;

			$data = $database->insert('crs_menu',[
				'id_hotel'    => $hotel,
				'description' => $descripcion,
				'link'        => $link,
				'title'       => $titulo,
				'menu_type'   => $idmenu,
				'menu_id'     => $menuid,
				'order_at'    => $orden,
				'new_window'  => $window,
				'active_at'   => 2,
				'lang'        => 1,
				'created_at'  => time()
			]);
			return $database->id();
		}


		public function saveImage($idhotel, $name_img, $titulo, $subtitulo, $descripcion){
			global $database;

			$data = $database->insert('crs_images_gallery',[
				'id_hotel'          => $idhotel,
				'imagen'            => $name_img,
				'title_image'       => $titulo,
				'subtitle_image'    => $subtitulo,
				'description_image' => $descripcion,
				'active_at'         => 2,
				'created_at'        => time()
			]);
			return $database->id();
		}

		public function saveSlider($idhotel, $name_img, $titulo, $subtitulo){
			global $database;

			echo $name_img, $titulo, $subtitulo, $descripcion;

			$data = $database->insert('crs_images_slider',[
				'id_hotel'          => $idhotel,
				'image'             => $name_img,
				'title'             => $titulo,
				'subtitle'          => $subtitulo,
				'active_at'         => 2,
				'created_at'        => time()
			]);
			return $database->id();
		}


		public function getMenuPadre($code){
			global $database;

			$data = $database->select('crs_menu',[
				'description'
			],[
				'id_menu' => $code
			]);
			return $data[0]['description'];

		}

		public function getMenus($hotel){
			global $database ;

			$data = $database->select('crs_menu',[
				'id_menu',
				'description',
				'link',
				'icon',
				'menu_id',
				'menu_type',
				'order_at',
				'title',
				'clase',
				'active_at',
				'new_window'
			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null,
				"ORDER" => ['menu_type' => 'ASC']
			]);
			return $data;
		}

		public function blockRoom($room,$code){
			global $database;

			$data = $database->update('crs_rooms',[
				'active_at' => $code
			],[
				'id_room' => $room
			]);
			return $data;
		}

		public function blockImage($image,$code){
			global $database;

			$data = $database->update('crs_images_gallery',[
				'active_at' => $code
			],[
				'id_image' => $image
			]);
			return $data;
		}

		public function blockImageSlider($image,$code){
			global $database;

			$data = $database->update('crs_images_slider',[
				'active_at' => $code
			],[
				'id_slider' => $image
			]);
			return $data;
		}

		public function blockImageGallery($image,$code){
			global $database;

			$data = $database->update('crs_images_room',[
				'active_at' => $code
			],[
				'id' => $image
			]);
			return $data;
		}

		public function blockSocial($social,$code){
			global $database;
			$data = $database->update('crs_menu_social',[
				'active_at' => $code
			],[
				'id_menu_social' => $social
			]);
			return $data;
		}

		public function blockArticle($article,$code){
			global $database;
			$data = $database->update('crs_articles',[
				'active_at' => $code
			],[
				'id_article' => $article
			]);
			return $data;
		}

		public function lockEvent($event,$code){
			global $database;
			$data = $database->update('crs_events',[
				'active_at' => $code
			],[
				'id_event' => $event
			]);
			return $data;
		}


		public function blockNews($news,$code){
			global $database;
			$data = $database->update('crs_news',[
				'active_at' => $code
			],[
				'id_news'    => $news
			]);
			return $data;
		}

		public function blockMenu($menu,$code){
			global $database;
			echo $menu;
			echo $code;

			$data = $database->update('crs_menu',[
				'active_at' => $code
			],[
				'id_menu'    => $menu
			]);
			return $data->rowCount();
		}


		public function cambiaClaveUsuario($id, $pass,$usuario){
			global $database;

			$data = $database->update('crs_users',[
				'password' => $pass
			],[
				'id_user' => $id
			]);
			return $data->rowCount();
		}

		public function updateUser($iduser,$apellidos,$nombres,$tipo,$email){
			global $database;

			$data = $database->update('crs_users',[
				'email'      => $email,
				'name'       => $nombres,
				'last_name'  => $apellidos,
				'type_at'    => $tipo,
				'updated_at' => time()
			],[
				'id_user' => $iduser
			]);
			return $data;
		}


		public function blokcUser($code,$user){
			global $database;

			$data = $database->update('crs_users',[
				'state_at' => $code
			],[
				'id_user' => $user
			]);
			return $data;
		}

		public function insertUser($usuario,$con,$apellidos,$nombres,$email,$tipo,$idhotel){
			global $database;

			$data = $database->insert('crs_users',[
				'user'       => $usuario,
				'password'   => $con,
				'last_name'  => $apellidos,
				'name'       => $nombres,
				'email'      => $email,
				'type_at'    => $tipo,
				'id_hotel'   => $idhotel,
				'state_at'   => 1,
				'created_at' => time()
			]);
			return $database->id();
		}

		public function getPlans($hotel){
			global $database;

			$data = $database->select('crs_plans',[
				'id_plan',
				'description_plan',
				'title',
				'subtitle',
				'value',
				'include_at',
				'no_include',
				'image',
				'active_at',
				'restring',
				'date_from',
				'date_to'
			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null
			]);
			return $data;
		}

		public function getUsers($hotel){
			global $database;

			$data = $database->select('crs_users',[
				'id_user',
				'email',
				'name',
				'last_name',
				'user',
				'state_at',
				'type_at'
			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null
			]);
			return $data;
		}

		public function getRooms($hotel){
			Global $database;

			$data = $database->select('crs_rooms',[
				'id_room',
				'id_hotel',
				'room_name',
				'image',
				'sub_text',
				'orden',
				'price',
				'pax_max',
				'pax_min',
				'beds',
				'adults',
				'kids',
				'inventory',
				'details',
				'active_at',
				'min_stay'

			],[
				'id_hotel' => $hotel,
				'deleted_at' => Null
			]);
			return $data;
		}

		public function getDayRates($hotel,$room){
			global $database;

			$data = $database->query("SELECT id, date_book as start, date_book as end, value as title FROM crs_rates_value where id_hotel = '$hotel' and id_room = '$room' order by date_book")->fetchAll();
			return $data;
		}

		public function getLogin($user,$pass,$hotel){ 
			global $database;

			$data = $database->select('crs_users',[
				'id_user',
				'email',
				'name',
				'last_name',
				'user',
				'state_at',
				'foto_usuario',
				'usuario',
				'type_at'
			],[
				'user'       => $user,
				'password'   => $pass,
				'id_hotel'   => $hotel,
				'deleted_at' => Null
			]);
			$regis = count($data);
			if($regis==0){
				return '0' ;
			}else{
				return $data;
			}
		}

		public function hotels($code){
			global $database;

			$data = $database->select('crs_hotels',[
				'id_hotel',
				'hotel_name',
				'nit',
				'email',
				'logo',
				'img_portada',
				'eslogan',
				'phone',
				'movil',
				'adress',
				'city',
				'land',
				'active_at',
				'rnt'
			],[
				'id_company' => $code,
				'deleted_at' => Null
			],[
				'ORDER' => 'hotel_name'
			]);
			return $data;
		}

		public function Login($user, $pass, $cia){
			global $database;

			$data = $database->select("crs_users",[
				'email', 
				'name',
				'last_name',
				'state_at',
				'type_at',
				"password"
			],[
				'id_cia' => $cia, 
				"user" => $user
			]);

			return $data;
		}

		public function getProfile($email){
			global $database;

			$admin = $database->select('admins',[
				'admin_id',
				'user_name'
			],[
				'email' => $email
			]);
			return $admin;
		}

		public function getCategories(){
			global $database;

			$categories = $database->select('categories',[
				'category_id',
				'category'
			]);

			return $categories;
		}

		public function saveCategory($category){
			global $database;

			$database->insert("categories", [
				"category" => htmlspecialchars(addslashes($category))
			]);
			return $database->id();
		}


		public function savePost($name, $category_id, $description, $name_img, $admin_id){

			global $database;

			$database->insert("posts", [
				"name"        => htmlspecialchars(addslashes($name)),
				"body"        => $description,
				"img_post"    => $name_img,
				"category_id" => htmlspecialchars(addslashes($category_id)),
				"admin_id"    => $admin_id,
				"created_at"  => time()
			]);

			return $database->id();
		}

		public function getPosts(){
			global $database;
			$posts = $database->select('posts',[
				'post_id',
				'name',
				'img_post',
				'created_at'
			],[
				'ORDER' => ['posts.post_id' => 'DESC']
			]);
			return $posts ;
		}

	}
 ?>