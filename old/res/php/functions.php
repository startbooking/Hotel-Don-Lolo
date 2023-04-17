<?php

require 'init.php';
date_default_timezone_set('America/Bogota');

class User_Actions
{
    public function getUserSocial($red) // Menu Redes Sociales
    {
        global $database;
        $data = $database->select('cms_menu_social', [
            'users',
        ], [
            'active_at' => '1',
            'description' => $red,
            'deleted_at' => null,
        ]);
        if (empty($data)) {
            return '';
        } else {
            return $data[0]['users'];
        }
    }

    public function getImagesHotel()
    {
        global $database;

        $data = $database->select('crs_images_room', [
            'image',
            'description',
        ], [
            'active_at' => 1,
            'deleted_at' => null,
            'ORDER' => 'orden',
        ]);

        return $data;
    }

    public function getSliderHotel()
    {
        global $database;

        $data = $database->select('cms_images_slider', [
            'image',
            'orden',
            'title',
            'subtitle',
            'button',
            'text_button',
            'link_button',
        ], [
            'deleted_at' => null,
            'active_at' => 1,
            'ORDER' => ['orden' => 'ASC'],
        ]);

        return $data;
    }

    public function getRoomHotel() // Habtaciones del Hotel Seleccionado
    {
        global $database;
        $data = $database->select('tipo_habitaciones', [
            'id',
            'descripcion_habitacion',
            'ordenCms',
            'foto',
            'max_pax',
            'min_pax',
            'camas',
            'subtitulo',
            'estadiaMin',
            'url',
        ], [
            'active_at' => 1,
            'tipo_habitacion' => 1,
            'ORDER' => ['ordenCms' => 'ASC'],
        ]);

        return $data;
    }

    public function getAboutHotel()
    {
        global $database;

        $data = $database->select('cms_hotels', [
            'hotel_name',
            'hotel_title',
            'hotel_subtitle',
            'hotel_about',
            'currency',
            'max_adults',
            'max_babys',
            'latitud',
            'longitud',
            'min_price',
            'tax',
            'tax_inc',
            'api_key_chat',
            'googlesite',
            'rnt',
        ]);

        return $data;
    }

    public function socialMenu() // Menu Redes Sociales
    {
        global $database;
        $data = $database->select('cms_menu_social', [
            'id_menu_social',
            'description',
            'mail',
            'users',
            'icon',
            'clase',
            'web',
        ], [
            'active_at' => '1',
            'deleted_at' => null,
        ]);

        return $data;
    }

    public function menuPrincipal() // Menu Principal
    {
        global $database;
        $data = $database->select('cms_menu', [
            'id_menu',
            'description',
            'icon',
            'link',
            'menu_id',
            'title',
            'clase',
            'new_window',
            'products',
            'type_products',
        ], [
            'active_at' => 1,
            'menu_type' => 1,
            'menu_id' => 0,
            'deleted_at' => null,
            'ORDER' => ['order_at' => 'ASC'],
        ]);

        return $data;
    }

    public function subMenuPrincipal($menu) // Menu Principal
    {
        global $database;
        $data = $database->select('cms_menu', [
            'id_menu',
            'description',
            'icon',
            'link',
            'menu_id',
            'title',
            'clase',
            'new_window',
        ], [
            'active_at' => 1,
            'menu_type' => 2,
            'menu_id' => $menu,
            'deleted_at' => null,
            'ORDER' => ['order_at' => 'ASC'],
        ]);

        return $data;
    }

    public function getEmpresaInfo($code) // Informacion Hotel
    {
        global $database;
        $data = $database->select('empresa', [
            'empresa',
            'nit',
            'dv',
            'regimen',
            'direccion',
            'pais',
            'ciudad',
            'telefonos',
            'celular',
            'web',
            'correo',
            'logo',
            'rnt',
        ]);

        return $data;
    }

    public function getHotelInfo() // Informacion Hotel
    {
        global $database;
        $data = $database->select('cms_hotels', [
            'id_hotel',
            'ower_hotel',
            'hotel_name',
            'nit_hotel',
            'movil',
            'email',
            'phone',
            'adress',
            'web',
            'language',
            'city',
            'land',
            'email_contact',
            'email_book',
            'min_price',
            'id_destination',
            'title_web',
            'description',
            'tax_inc',
            'logo',
            'icono',
            'img_portada',
            'eslogan',
            'latitud',
            'longitud',
            'currency',
            'color_menu',
            'font_menu',
            'color_footer',
            'font_footer',
            'color_card',
            'font_card',
            'max_adults',
            'max_babys',
            'api_key_maps',
            'api_key_analytics',
            'api_key_googletag',
            'keyword_text',
            'message_footer',
            'template',
            'img_portada',
            'check_in',
            'check_out',
            'mmto',
            'textoMmto',
            'active_at',
        ], [
            'deleted_at' => null,
        ], [
            'ORDER' => 'order_at',
        ]);

        return $data;
    }

    public function adicionaSoporte($name, $email, $phone, $subject, $comments, $idSoporte, $ip)
    {
        global $database;

        $data = $database->insert('soporteTecnico', [
            'cliente' => $name,
            'correo' => $email,
            'telefono' => $phone,
            'asunto' => $subject,
            'mensaje' => $comments,
            'key' => $idSoporte,
            'estado' => 1,
            'ip_equipo' => $ip,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getSesionLogin($user)
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
            'correo',
            'nombres',
            'apellidos',
            'usuario',
            'estado',
            'foto_usuario',
            'usuario',
            'tipo',
            'ingreso',
            'empresa_id',
            'inv',
            'pos',
            'pms',
            'res',
            'id_ambiente',
            'estado_usuario_pms',
            'estado_usuario_pos',
        ], [
            'usuario_id' => $user,
        ]);

        return $data;
    }

    public function usuarioActivo($id, $tipo)
    {
        global $database;

        $data = $database->update('usuarios', [
            'ingreso' => $tipo,
        ], [
            'usuario_id' => $id,
        ]);

        return $data->rowCount();
    }

    public function buscaDireccion($ip)
    {
        global $database;

        $data = $database->count('accesos', [
            'id',
        ], [
            'direccion' => $ip,
            'actived_at' => 1,
            'deleted_at' => null,
        ]);

        return $data;
    }

    public function ingresoLog($id, $user, $pc, $ip, $accion, $inicial, $final, $modulo)
    {
        global $database;

        $data = $database->insert('log', [
            'idregistro' => $id,
            'usuario' => $user,
            'equipo' => $pc,
            'accion' => $accion,
            'iplog' => $ip,
            'datoinicial' => $inicial,
            'datofinal' => $final,
            'modulo' => $modulo,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function reabreUsuario($id)
    {
        global $database;

        $data = $database->update('usuarios', [
            'estado_usuario_pms' => 1,
        ], [
            'usuario_id' => $id,
        ]);

        return $data->rowCount();
    }

    public function cambiaClaveUsuario($pass, $user, $id)
    {
        global $database;

        $data = $database->update('usuarios', [
            'password' => $pass,
        ], [
            'usuario_id' => $id,
        ]);

        return $data->rowCount();
    }

    public function verificaClaveActual($user, $pass)
    {
        global $database;

        $data = $database->count('usuarios', [
            'usuario' => $user,
            'password' => $pass,
        ]);

        return $data;
    }

    public function bloqueaUsuario($estado, $id)
    {
        global $database;

        $data = $database->update('usuarios', [
            'estado' => $estado,
        ], [
            'usuario_id' => $id,
        ]);

        return $data->rowCount();
    }

    public function updateUserPass($usuario, $clave, $id)
    {
        global $database;

        $data = $database->update('usuarios', [
            'password' => $clave,
        ], [
            'usuario_id' => $id,
        ]);

        return $data->rowCount();
    }

    public function buscaUser($user)
    {
        global $database;

        $data = $database->count('usuarios', [
            'usuario' => $user,
        ]);

        return $data;
    }

    public function insertUserNew($usuario, $claveIn, $apellidos, $nombres, $identificacion, $correo, $telefono, $celular, $tipo, $fecha)
    {
        global $database;

        $data = $database->insert('usuarios', [
            'identificacion' => $identificacion,
            'estado' => 'A',
            'nombres' => strtoupper($nombres),
            'apellidos' => strtoupper($apellidos),
            'correo' => strtolower($correo),
            'telefono' => $telefono,
            'celular' => $celular,
            'usuario' => strtoupper($usuario),
            'password' => $claveIn,
            'tipo' => $tipo,
            'created_at' => $fecha,
        ]);

        return $database->id();
    }

    public function getImpuestos()
    {
        global $database;

        $data = $database->select('impuestos', [
            'id_impto',
            'descripcion_impto',
            'mpo_impto',
            'tipo_impto',
            'cta_impto',
        ]);

        return $data;
    }

    public function getUsuariosSistema()
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
            'identificacion',
            'estado',
            'nombres',
            'apellidos',
            'correo',
            'telefono',
            'celular',
            'usuario',
            'tipo',
            'foto_usuario',
        ]);

        return $data;
    }

    public function getLogin($user, $pass)
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
            'correo',
            'nombres',
            'apellidos',
            'usuario',
            'estado',
            'foto_usuario',
            'usuario',
            'tipo',
            'ingreso',
            'multipleIngreso',
            'empresa_id',
            'inv',
            'pos',
            'pms',
            'res',
            'id_ambiente',
            'estado_usuario_pms',
            'estado_usuario_pos',
        ], [
            'usuario' => $user,
            'password' => $pass,
            'deleted_at' => null,
        ]);

        return $data;
    }

    public function getInfoCia()
    {
        global $database;

        $data = $database->select('empresas', [
            'con',
            'inv',
            'com',
            'cxp',
            'cxc',
            'pos',
            'tar',
            'pms',
            'res',
            'empresa',
            'nit',
            'dv',
            'direccion',
            'pais',
            'ciudad',
            'celular',
            'telefonos',
            'web',
            'correo',
            'logo',
            'codigo_ciiu',
            'ip_acceso',
            'tipo_empresa',
            'cms',
        ]);

        return $data;
    }

    public function getDatePos()
    {
        global $database;

        $data = $database->select('parametros_pos', [
            'fecha_auditoria',
        ]);

        return $data;
    }

    public function getDatePms()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'fecha_auditoria',
        ]);

        return $data;
    }

    public function getTypeCia($tipo)
    {
        global $database;

        $data = $database->select('tipo_cia', [
            'descripcion',
        ], [
            'id_tipo_cia' => $tipo,
        ]);

        return $data[0]['descripcion'];
    }
}
