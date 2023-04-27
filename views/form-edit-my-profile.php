<?php

/**
 * Edit profile form
 * This file is used to mark up the edit profile form
 * You may replace this view by adding a file with the same name to your theme folder
 * inside a folder called "user-profiles".
 * Ex: /wp-content/themes/my-theme/user-profiles/form-edit-my-profile.php
 */

namespace banana\user_profiles;

$Profile = new Profile();

// Load all editable sections
$sections = apply_filters(
	'user_profile_editable_sections',
	[]
);

// Action hook before displaying sections
do_action( 'user_profile_hook_before_displaying_sections', $sections, get_current_user_id() );

$Profile->maybe_display_notice();
?>
<div class="user-profile-edit-form">
	<div class="user-profile-edit-form__header">
		<?php echo '<a href="' . esc_url( $Profile->my_profile_url() ) . '">' . __( 'Back to my profile', 'banana-user-profiles' ) . '</a>'; ?>
	</div>
	<div class="user-profile-edit-form__body">
		<ul class="user-profile-edit-form__sidebar">
			<?php
			foreach ( $sections as $section ) {
				echo '<li><a href="#' . esc_attr( $section['id'] ) . '">' . esc_html( $section['title'] ) . '</a></li>';
			}
			?>
		</ul>
		<div class="user-profile-edit-form__sections">
			<?php
			// Loop through each item
			foreach ( $sections as $section ) {

				// Build the content class
				$content_class = '';

				// If we have a class provided
				if ( '' !== $section['content_class'] ) {
					$content_class .= ' ' . $section['content_class'];
				}
				?>

				<div
					class="user-profile-edit-form__section user-profile-edit-form__section-<?php echo esc_attr( $content_class ); ?>"
					id="<?php echo esc_attr( $section['id'] ); ?>" style="display:none;">

					<form method="post"
					      action="<?php echo esc_url( $Profile->edit_my_profile_url() . '#' . $section['id'] ); ?>"
					      enctype='multipart/form-data'>
						<?php
						// Check if this section has a custom callback function
						if ( isset( $section['callback'] ) && function_exists( $section['callback'] ) ) {
							// Use custom callback function
							$section['callback']( $section );
						} else {
							// Use default callback function
							$Profile->display_editable_section( $section );
						}

						wp_nonce_field(
							'user_profile_edit_profile_action',
							'edit-profile-nonce'
						);
						?>
						<input type="submit" value="<?php _e( 'Save', 'banana-user-profiles' ); ?>">
					</form>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>

<script>
    /**
     * This little script handles the sidebar navigation. When the user clicks on a link in the sidebar,
     * the corresponding section is displayed and the link is marked as active.
     * Feel free to move it into its own file and enqueue it in your theme, remove it, or modify it.
     * Whatever you like!
     */

    const sections = document.querySelectorAll('.user-profile-edit-form__section');
    const links = document.querySelectorAll('.user-profile-edit-form__sidebar a');
    let currentHash = window.location.hash || '#profile';

    displayCurrentSection();
    makeCurrentSidebarLinkActive();

    // Add classname "active" to the current link
    function makeCurrentSidebarLinkActive(){
        links.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === currentHash) {
                link.classList.add('active');
            }
        });
	}

    // Hide all sections and show the current one
    function displayCurrentSection() {
		sections.forEach(section => {
			section.style.display = 'none';
		});
		document.querySelector(currentHash).style.display = 'block';
	}

    // Listen for hashchange event
    window.addEventListener('hashchange', () => {
        currentHash = window.location.hash || '#profile';
        displayCurrentSection();
        makeCurrentSidebarLinkActive();
    });
</script>