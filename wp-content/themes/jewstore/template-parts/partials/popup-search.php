      <div class="wpdevart-search-overlay" id="wpdevartModalContainer">
          <div class="wpdevart-search-overlay-layout">
            <form method="get" class="search-term" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="wpdevart-search-container">
                <label>
                  <input type="search" class="search-term" id="wpdevartfocusonoverlayinputwide"
                  placeholder="<?php echo esc_attr__( 'Enter a search term here...', 'jewstore'); ?>"
                  value="<?php echo esc_attr(get_search_query()); ?>" name="s"
                  />
                  <button type="submit" class="search-overlay-submit-button"><i class="fa fa-search wpdevart-search-overlay-icon" aria-hidden="true"></i></button>
                </label>
                <button type="button" onClick="wpdevartToggleModal()" class="search-overlay-close-wide-button" id="restoresearchbuttonfocus">
                  <i class="fa fa-close search-overlay-close-icon" aria-hidden="true"></i>
                </button>  
                </div>
            </form>
            <div tabIndex="0"></div>
          </div>
      </div>
 
      <div class="wpdevart-search-overlay" id="wpdevartModalContainerSmall">
          <div class="wpdevart-search-overlay-layout">
              <form method="get" class="search-term" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="wpdevart-search-container">
                    <label>
                      <input type="search" class="search-term" id="wpdevartfocusonoverlayinputsmall"
                      placeholder="<?php echo esc_attr__( 'Search term...', 'jewstore'); ?>"
                      value="<?php echo esc_attr(get_search_query()); ?>" name="s"
                      />
                      <button type="submit" class="search-overlay-submit-button"><i class="fa fa-search wpdevart-search-overlay-icon" aria-hidden="true"></i></button>
                    </label>
                    <button type="button" onClick="wpdevartToggleModalSmall()" class="search-overlay-close-button" id="restoresmallsearchbuttonfocus">
                    <i class="fa fa-close search-overlay-close-icon" aria-hidden="true"></i>
                    </button>
                </div>
              </form>
              <div tabIndex="0"></div>
          </div>
      </div>