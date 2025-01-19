<?php
    /*
    Plugin Name: Alejandro Plugin
    Description: Plugin de gestion des préférences utilisateurs
    Version: 1.0
    Author: Votre Nom
    Text Domain: alejandro-plugin
    */

    // Activation du plugin
    register_activation_hook(__FILE__, 'alejandro_create_tables');

    function alejandro_create_tables() {
      global $wpdb;
      
      $charset_collate = $wpdb->get_charset_collate();
      
      $sql = "CREATE TABLE {$wpdb->prefix}alejandro_users (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        username varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        PRIMARY KEY (id)
      ) $charset_collate;
      
      CREATE TABLE {$wpdb->prefix}alejandro_preferences (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        language varchar(50) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id) REFERENCES {$wpdb->prefix}alejandro_users(id)
      ) $charset_collate;
      
      CREATE TABLE {$wpdb->prefix}alejandro_settings (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        plugin_name varchar(255) NOT NULL,
        plugin_version varchar(50) NOT NULL,
        PRIMARY KEY (id)
      ) $charset_collate;";
      
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
    }

    // [Reste du code existant...]
    ?>
