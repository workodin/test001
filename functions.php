<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

function git_loader ()
{
    if (!is_404()) return;
    
    $url = $_SERVER["REQUEST_URI"];
    
    $path = parse_url($url, PHP_URL_PATH);
    if ("/" == mb_substr($path, -1)) {
        $path = $path . "index.php";
    }
    
    extract(pathinfo($path));
    
    $dirname = trim($dirname, "/");
    $master5    = md5("$dirname");
        
    $targetFile = __DIR__ . "/$dirname/$filename.$extension";
    if (is_file($targetFile))
    {
        // SECURITY
        $gitCapability = "read";
    
        if (($gitCapability != "") && current_user_can($gitCapability) ) 
        {
            status_header(200);
            
            $extension = strtolower($extension);
            switch($extension)
            {
                case "css":
                    header("Content-Type: text/css");
                    break;
                case "js":
                        header("Content-Type: application/javascript");
                    break;
                case "php":
                        header("Content-Type: text/html");
                    break;
                default:
                    $mimeType = mime_content_type($targetFile);
                    header("Content-Type: $mimeType");
            }
    
            if ("php" == $extension)
            {
                // protection contre modif fichiers
                ini_set("open_basedir", "/tmp:" .__DIR__ . "/$dirname");
                include $targetFile;
            }
            else
            {
                readfile($targetFile);
            }
            // stop wordpress
            die();

        }
        else
        {
            auth_redirect();
            echo "$targetFile";
        }
    
    }
    
}

add_action('template_redirect', 'git_loader' );
