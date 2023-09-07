<div class="jssocials-shares">
<p class="seprator"><span>OR</span></p>
<?php foreach ( $providers as $provider ) : //echo '<pre>'; print_r($provider); echo'</pre>';?>
    <div class="jssocials-share jssocials-share-<?php echo $provider ?>">
        <a href="<?php echo add_query_arg( array( 'vendor_social_reg' => $provider ), $base_url ); ?>" class="jssocials-share-link">
            <i class="fa fa-<?php echo $provider ?> jssocials-share-logo"></i> Login with <span><?php echo $provider; ?></span>
        </a>
    </div>
<?php  endforeach; ?>
</div>
