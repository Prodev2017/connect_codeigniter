<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Contains labels for registration, log in, setup, edit account, forgot password



// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_title']           = 'Connectably - Login';
$lang['login_heading']         = 'Sign in to your account';
$lang['login_subheading']      = 'Please login with your email/username and password below.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Remember Me:';
$lang['login_submit_btn']      = 'LOGIN';
$lang['login_forgot_password'] = 'Forgot your password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_timezone']          = 'Timezone';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_title']                             = 'Connectably - Register User';
$lang['create_user_heading']                           = 'Create User';
$lang['create_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['create_user_fname_label']                       = 'First Name:';
$lang['create_user_lname_label']                       = 'Last Name:';
$lang['create_user_company_label']                     = 'Company Name:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Phone:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Confirm Password:';
$lang['create_user_submit_btn']                        = 'Create User';
$lang['create_user_validation_fname_label']            = 'First Name';
$lang['create_user_validation_lname_label']            = 'Last Name';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Email Address';
$lang['create_user_validation_phone_label']            = 'Phone';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';
$lang['create_user_remember_me']                       = 'Remember Me';
$lang['create_user_have_account']                      = 'Already have an account?';
$lang['create_user_sign_in_here']                      = 'Sign in here';

// Edit User
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone_label']            = 'Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';

// set up pages
$lang['setup_xero_wrong_details']               = 'The Xero details you have entered appear to be incorrect, please try again.';
$lang['setup_wrong_details']                    = 'Wrong details';
$lang['setup_xero']                             = 'Setup Xero';
$lang['setup_xero_code']                        = 'Create private app using X509 below:';
$lang['setup_xero_copy']                        = 'Copy to clipboard';
$lang['setup_xero_unable_to_copy']              = 'Unable to copy to clipboard. Please manually copy the certificate.';
$lang['setup_enter_xero_details']               = 'Enter your Xero details:';
$lang['setup_progress']                         = 'Setup Progress';
$lang['setup_progress_1']                       = 'Part 1 of 3';
$lang['setup_progress_2']                       = 'Part 2 of 3';
$lang['setup_progress_3']                       = 'Part 3 of 3';
$lang['setup_xero_consumer_key']                = 'Consumer Key';
$lang['setup_xero_consumer_secret']             = 'Consumer Secret';

$lang['setup_gocardless']                       = 'Setup GoCardless';
$lang['setup_gocardless_wrong_details']         = 'The GoCardless details you have entered appear to be incorrect, please try again';
$lang['setup_gocardless_access_token']          = 'Access Token';

$lang['setup_stripe']                           = 'Setup Stripe';
$lang['setup_stripe_wrong_details']             = 'The Stripe details you have entered appear to be incorrect, please try again.';
$lang['setup_stripe_publishable_key']           = 'Publishable Key';
$lang['setup_stripe_secret_key']                = 'Secret Key';

$lang['complete']                               = 'Complete';
$lang['setup_successfully_completed']           = 'You have successfully completed registration';
$lang['complete_setup_btn']                     = 'Complete Setup';


//Cancel anything
$lang['cancel_button']                       = 'CANCEL';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_identity_label']          = 'Identity';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';
$lang['forgot_password_identity_not_found']      = 'No record of that username.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Settings Page
$lang['settings_linkedin']                         = 'LinkedIn:';
$lang['settings_twitter']                          = 'Twitter:';
$lang['settings_facebook']                         = 'Facebook:';
$lang['settings_googleplus']                       = 'Google Plus:';

$lang['settings_initial_setup']                  = '1. Initial Setup';
$lang['settings_business']                       = '2. My Business';
$lang['settings_users']                          = '3. Users';
$lang['settings_workflows']                      = '4. Workflows';
$lang['settings_stages']                         = '5. Stages';
$lang['settings_outcomes']                       = '6. Outcomes';
$lang['settings_automations']                    = '7. Automations';
$lang['settings_opportunities']                  = '8. Opportunities';
$lang['settings_templates']                      = '9. Templates';
$lang['settings_custom_fields']                  = '10. Custom Fields';
$lang['settings_tags']                           = '11. Tags';
$lang['settings_connected_apps']                 = '12. Connected Apps';
$lang['settings_import']                         = '13. Import';
$lang['settings_report']                         = '14. Reports';

$lang['settings_company']                        = 'Company name:';
$lang['settings_branches']                       = 'Branches:';
$lang['settings_addresses']                      = 'Addresses';
$lang['settings_phones']                         = 'Phones';

$lang['next_btn']                                = 'Next';
$lang['back_btn']                                = 'Back';
$lang['close_btn']                               = 'Close';
$lang['delete_btn']                              = 'Delete';
$lang['add_btn']                                 = 'Add';
$lang['save_btn']                                = 'Save';

$lang['settings_fname']                             = 'First Name';
$lang['settings_lname']                             = 'Last Name';
$lang['settings_email']                             = 'Email';
$lang['settings_status']                            = 'Status';
$lang['settings_company']                           = 'Company';
$lang['settings_address']                           = 'Address';
$lang['settings_phone']                             = 'Phone';
$lang['settings_social_media']                      = 'Social Media Profiles';
$lang['settings_actions']                           = 'Actions';

$lang['settings_edit']                           = 'Edit';


$lang['settings_custom_fields']                            = 'Custom Fields';
$lang['settings_custom_fields_settings']                   = 'Custom Fields Settings';
$lang['settings_custom_fields_add_header']                 = 'Add Header';
$lang['settings_custom_fields_add']                        = 'Add Custom Field';
$lang['settings_custom_fields_edit']                       = 'Edit';
$lang['settings_custom_fields_location']                   = 'Location';
$lang['settings_custom_fields_contact']                    = 'Contact';
$lang['settings_custom_fields_header_name']                = 'Header Name';
$lang['settings_custom_fields_header_warning']             = 'Warning! This willd delete all the fields under this header.';
$lang['settings_custom_fields_header']                     = 'Header';
$lang['settings_custom_fields_type']                       = 'Type';
$lang['settings_custom_fields_field_name']                 = 'Field Name';


$lang['settings_tags_choose_tag_category']              = 'Choose Tag Category Colour';
$lang['settings_tags_sub_cat']                          = 'Sub Category:';
$lang['settings_tags_add_new_tag']                      = 'Add New Tag';
$lang['settings_tags_tag']                              = 'Tag';
$lang['settings_tags_description']                      = 'Description';
$lang['settings_tags_actions']                          = 'Actions';
$lang['settings_tags_edit_tag']                         = 'Edit Tag Name & Description';
$lang['settings_tags_name']                             = 'Name:';
$lang['settings_tags_tag_category']                     = 'Tag Category:';
$lang['settings_tags_tag_sub_cat']                      = 'Tag Sub Category';



//description of each settings section
$lang['settings_outcomes_info']                             = 'Change the name and associated steps.';
$lang['settings_initial_setup_info']                        = 'Manage your connection to Xero, GoCardless and Stripe.';
$lang['settings_my_business_info']                          = 'Change your business contact information, connect to your social media accounds and set default users. ';
$lang['settings_users_info']                                = 'Manage users associated with this account and edit their contact information.';
$lang['settings_workflows_info']                            = 'Change workflows names, order and owner. ';
$lang['settings_opportunities_info']                        = 'Categorise opportunities by choosing their name and colours. ';
$lang['settings_templates_info']                            = '';
$lang['settings_tags_info']                                 = 'Create new tags or change an existing tags colour. ';
$lang['settings_automations_info']                          = '';
$lang['settings_stages_info']                               = 'Enquiries, connections, sales, getting paid, results. ';
$lang['settings_connected_apps_info']                       = 'Manage your connected apps, check the status of their connection and link to accounting software.';
$lang['settings_import_info']                               = 'Import contact and company records into the system, as well as opportunities and emails, from a CSV or another system.';
$lang['settings_reports_info']                              = 'Upload and import company and contact records, as well as opportunities and emails. Upload a file below:';
