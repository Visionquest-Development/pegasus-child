<?php
/**
 * Collapsible Search Template
 * Displays search form in a collapsible container below the main navigation
 */

// Get the search menu option
$searchmenuchk = pegasus_get_option( 'search_box_chk' );

// Only display if search is enabled
if ( 'on' === $searchmenuchk ) :
?>
<div class="search-collapse-container">
    <div class="collapse" id="headerSearchCollapse" aria-labelledby="searchToggleButton">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="search-form-wrapper py-3">
                        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="input-group">
                                <input 
                                    type="search" 
                                    class="form-control search-field" 
                                    placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'pegasus-bootstrap' ); ?>" 
                                    value="<?php echo get_search_query(); ?>" 
                                    name="s" 
                                    id="headerSearchInput"
                                    aria-label="<?php echo esc_attr_x( 'Search for:', 'label', 'pegasus-bootstrap' ); ?>"
                                />
                                								<button 
									type="submit" 
									class="btn searchSubmit"
									aria-label="<?php echo esc_attr_x( 'Search', 'submit button', 'pegasus-bootstrap' ); ?>"
								>
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>