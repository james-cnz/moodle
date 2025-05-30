<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
//
// This file is part of BasicLTI4Moodle
//
// BasicLTI4Moodle is an IMS BasicLTI (Basic Learning Tools for Interoperability)
// consumer for Moodle 1.9 and Moodle 2.0. BasicLTI is a IMS Standard that allows web
// based learning tools to be easily integrated in LMS as native ones. The IMS BasicLTI
// specification is part of the IMS standard Common Cartridge 1.1 Sakai and other main LMS
// are already supporting or going to support BasicLTI. This project Implements the consumer
// for Moodle. Moodle is a Free Open source Learning Management System by Martin Dougiamas.
// BasicLTI4Moodle is a project iniciated and leaded by Ludo(Marc Alier) and Jordi Piguillem
// at the GESSI research group at UPC.
// SimpleLTI consumer for Moodle is an implementation of the early specification of LTI
// by Charles Severance (Dr Chuck) htp://dr-chuck.com , developed by Jordi Piguillem in a
// Google Summer of Code 2008 project co-mentored by Charles Severance and Marc Alier.
//
// BasicLTI4Moodle is copyright 2009 by Marc Alier Forment, Jordi Piguillem and Nikolas Galanis
// of the Universitat Politecnica de Catalunya http://www.upc.edu
// Contact info: Marc Alier Forment granludo @ gmail.com or marc.alier @ upc.edu.

/**
 * Strings for component 'mod_lti', language 'en'.
 *
 * @package mod_lti
 * @copyright  2009 Marc Alier, Jordi Piguillem, Nikolas Galanis
 *  marc.alier@upc.edu
 * @copyright  2009 Universitat Politecnica de Catalunya http://www.upc.edu
 * @author     Marc Alier
 * @author     Jordi Piguillem
 * @author     Nikolas Galanis
 * @author     Chris Scribner
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['accept'] = 'Accept';
$string['accepted'] = 'Accepted';
$string['accept_grades'] = 'Accept grades from the tool';
$string['accept_grades_admin'] = 'Accept grades from the tool';
$string['accept_grades_admin_help'] = 'Specify whether the tool provider can add, update, read, and delete grades associated with instances of this tool.

Some tool providers support reporting grades back to Moodle based on actions taken within the tool, creating a more integrated
experience.';
$string['accept_grades_help'] = 'Specify whether the tool provider can add, update, read, and delete grades associated only with this external tool instance.

Some tool providers support reporting grades back to Moodle based on actions taken within the tool, creating a more integrated experience.

Note that this setting may be overridden in the tool configuration.';
$string['accept_grades_from_tool'] = 'Allow {$a} to add grades in the gradebook';
$string['action'] = 'Action';
$string['activate'] = 'Activate';
$string['activatetoadddescription'] = 'You will need to activate this tool before you can add a description.';
$string['active'] = 'Active';
$string['activity'] = 'Activity';
$string['add_ltiadv'] = 'Add LTI Advantage';
$string['add_ltilegacy'] = 'Add Legacy LTI';
$string['addnewapp'] = 'Enable external application';
$string['addserver'] = 'Add new trusted server';
$string['addtool'] = 'Add tool';
$string['addtype'] = 'Add preconfigured tool';
$string['allow'] = 'Allow';
$string['allowsetting'] = 'Allow tool to store 8K of settings in Moodle';
$string['always'] = 'Always';
$string['automatic'] = 'Automatic, based on tool URL';
$string['autoaddtype'] = 'Add tool';
$string['baseurl'] = 'Base URL/tool registration name';
$string['basiclti'] = 'LTI';
$string['basiclti_base_string'] = 'LTI OAuth base string';
$string['basiclti_endpoint'] = 'LTI launch endpoint';
$string['basiclti_in_new_window'] = 'Your activity has opened in a new window';
$string['basiclti_in_new_window_open'] = 'Open in new window';
$string['basiclti_parameters'] = 'LTI launch parameters';
$string['basicltiactivities'] = 'LTI activities';
$string['basicltifieldset'] = 'Custom example fieldset';
$string['basicltiintro'] = 'Activity description';
$string['basicltiname'] = 'Activity name';
$string['basicltisettings'] = 'Basic Learning Tool Interoperability (LTI) settings';
$string['cachedef_keyset'] = 'Caches the keyset information of tools';
$string['cancel'] = 'Cancel';
$string['cancelled'] = 'Cancelled';
$string['capabilities'] = 'Capabilities';
$string['capabilitiesrequired'] = 'This tool requires access to the following data in order to activate:';
$string['capabilities_help'] = 'Select those capabilities which you wish to offer to the tool provider.  More than one capability can be selected.';
$string['cleanaccesstokens'] = 'External tool removal of expired access tokens';
$string['click_to_continue'] = '<a href="{$a->link}" target="_top">Click to continue</a>';
$string['clientidadmin'] = 'Client ID';
$string['clientidadmin_help'] = 'The client ID is a unique value used to identify a tool. It is created automatically for each tool which uses the JWT security profile introduced in LTI 1.3 and should be part of the details passed to the tool provider so that they can configure the connection at their end.';
$string['comment'] = 'Comment';
$string['configpassword'] = 'Default remote tool password';
$string['configpreferheight'] = 'Default preferred height';
$string['configpreferwidget'] = 'Set widget as default launch';
$string['configpreferwidth'] = 'Default preferred width';
$string['configresourceurl'] = 'Default resource URL';
$string['configtoolurl'] = 'Default remote tool URL';
$string['configtypes'] = 'Enable LTI applications';
$string['configured'] = 'Configured';
$string['confirmtoolactivation'] = 'Are you sure you would like to activate this tool?';
$string['contentitem_deeplinking'] = 'Supports Deep Linking (Content-Item Message)';
$string['contentitem_deeplinking_help'] = 'If ticked, the option \'Select content\' will be available when adding an external tool.';
$string['contentitem_multiple_description'] = 'The following items will be added to your course:';
$string['contentitem_multiple_graded'] = 'Graded activity (Maximum grade: {$a})';
$string['contentselected'] = 'Content selected';
$string['courseactivitiesorresources'] = 'Course activities or resources';
$string['courseexternaltooladd'] = 'Add new LTI External tool';
$string['courseexternaltooladdsuccess'] = '{$a} added.';
$string['courseexternaltooledit'] = 'Edit {$a}';
$string['courseexternaltooleditsuccess'] = 'Changes saved.';
$string['courseexternaltooliconalt'] = 'Icon for {$a}';
$string['courseexternaltools'] = 'LTI External tools';
$string['courseexternaltoolsinfo'] = 'LTI External tools are add-on apps you can integrate into your course, such as interactive content or assessments. Your students can access and use them without leaving your course.';
$string['courseexternaltoolsnoeditpermissions'] = 'You don\'t have permission to edit this tool';
$string['courseexternaltoolsnoviewpermissions'] = 'View course external tools';
$string['courseid'] = 'Course ID number';
$string['courseinformation'] = 'Course information';
$string['courselink'] = 'Go to course';
$string['coursemisconf'] = 'Course is misconfigured';
$string['coursetooldeleted'] = '{$a} deleted';
$string['createdon'] = 'Created on';
$string['curllibrarymissing'] = 'PHP cURL extension required for the External tool.';
$string['custom'] = 'Custom parameters';
$string['custom_help'] = 'Custom parameters are settings used by the tool provider. For example, a custom parameter may be used to display
a specific resource from the provider.  Each parameter should be entered on a separate line using a format of "name=value"; for example, "chapter=3".

It is safe to leave this field unchanged unless directed by the tool provider.';
$string['custominstr'] = 'Custom parameters';
$string['debuglaunch'] = 'Debug option';
$string['debuglaunchoff'] = 'Normal launch';
$string['debuglaunchon'] = 'Debug launch';
$string['default'] = 'Default';
$string['default_launch_container'] = 'Default launch container';
$string['default_launch_container_help'] = 'The launch container affects the display of the tool when launched from the course. Some launch containers provide more screen
real estate to the tool, and others provide a more integrated feel with the Moodle environment.

* **Default** - Use the launch container specified by the tool configuration.
* **Embed** - The tool is displayed within the existing Moodle window, in a manner similar to most other Activity types.
* **Embed, without blocks** - The tool is displayed within the existing Moodle window, with just the navigation controls
        at the top of the page.
* **New window** - The tool opens in a new window, occupying all the available space.
        Depending on the browser, it will open in a new tab or a popup window.
        It is possible that browsers will prevent the new window from opening.';
$string['delegate'] = 'Delegate to teacher';
$string['delegate_tool'] = 'As specified in Deep Linking definition or Delegate to teacher';
$string['delete'] = 'Delete';
$string['delete_confirmation'] = 'Are you sure you want to delete this preconfigured tool?';
$string['deletecoursetool'] = 'Delete {$a}';
$string['deletecoursetoolconfirm'] = 'This will delete {$a} from the available LTI tools in your course.';
$string['deletecoursetoolwithusageconfirm'] = '{$a} is currently being used in at least one activity in your course. If you delete this tool, the activities that use it will no longer work.<br><br>Are you sure you want to delete {$a}?';
$string['display_description'] = 'Display activity description when students access the tool';
$string['display_description_help'] = 'Content from this tool is displayed embedded in a page in the course. This setting determines if the activity description is shown in that page.';
$string['display_name'] = 'Display activity name when students access the tool';
$string['display_name_help'] = 'Content from this tool is displayed embedded in a page in the course. This setting determines if the activity name is shown in that page.';
$string['donot'] = 'Do not send';
$string['donotaccept'] = 'Do not accept';
$string['donotallow'] = 'Do not allow';
$string['dynreg_update_text'] = 'There are existing tools attached to the registration\'s domain. Do you want to update an already installed
external tool or create a new external tool?';
$string['dynreg_update_warn_dupdomain'] = 'It is not recommended to have multiple external tools under the same domain.';
$string['dynreg_update_name'] = 'Tool name';
$string['dynreg_update_url'] = 'Base URL';
$string['dynreg_update_version'] = 'LTI version';
$string['dynreg_update_notools'] = 'No tools in context.';
$string['dynreg_update_btn_update'] = 'Update';
$string['dynreg_update_btn_new'] = 'Register as a new external tool';
$string['duplicateregurl'] = 'This registration URL is already in use';
$string['editdescription'] = 'Click here to give this tool a description';
$string['editmanualinstancedeprecationwarning'] = 'Manually configured External tool activities are no longer supported. Don\'t worry, this activity will still work as it is, but you can\'t make changes to the tool configuration here anymore.
<br><br>
To make any changes to the tool, or to create new activities with it, the tool needs to be added to your course in Course > More > LTI External tools. Then, you will be able to create new activities, selecting the tool directly in the Activity chooser.
<br><br>
You can read more about adding LTI External tools in the documentation <a href="{$a}" target="_blank">External tool</a>.';
$string['embed'] = 'Embed';
$string['embed_no_blocks'] = 'Embed, without blocks';
$string['enableemailnotification'] = 'Send notification emails';
$string['enableemailnotification_help'] = 'If enabled, students will receive email notification when their tool submissions are graded.';
$string['enterkeyandsecret'] = 'Enter your consumer key and shared secret';
$string['enterkeyandsecret_help'] = 'If you were given a consumer key and/or shared secret, input them here';
$string['entitycourseexternaltools'] = 'LTI External tools';
$string['errorbadurl'] = 'URL is not a valid tool URL or cartridge.';
$string['errorincorrectconsumerkey'] = 'Consumer key is incorrect.';
$string['errorinvaliddata'] = 'Invalid data: {$a}';
$string['errorinvalidmediatype'] = 'Invalid media type: {$a}';
$string['errorinvalidresponseformat'] = 'Invalid Content-Item response format.';
$string['errormisconfig'] = 'Misconfigured tool. Please ask your Moodle administrator to fix the configuration of the tool.';
$string['errortooltypenotfound'] = 'LTI tool type not found.';
$string['existing_window'] = 'Existing window';
$string['extensions'] = 'LTI extension services';
$string['external_tool_type'] = 'Preconfigured tool';
$string['external_tool_type_help'] = '* **Automatic, based on tool URL** - The best tool configuration is selected automatically. If the tool URL is not recognised, the tool configuration details may need to be entered manually.
* **A specific preconfigured tool** - The tool configuration for the specified tool will be used when communicating with the external tool provider. If the tool URL does not appear to belong to the tool provider, a warning will be shown. It is not always necessary to enter a tool URL.
* **Custom configuration** - A consumer key and shared secret may need to be entered manually. The consumer key and shared secret may be obtained from the tool provider. However, not all tools require a consumer key and shared secret, in which case the fields may be left blank.

### Preconfigured tool editing

Three icons are available after the preconfigured tool drop-down menu:

* **Add** - Create a course level tool configuration. All External tool instances in this course may use the tool configuration.
* **Edit** - Select a course level tool from the drop-down menu, then click this icon. The details of the tool configuration may be edited.
* **Delete** - Remove the selected course level tool.';
$string['external_tool_types'] = 'Preconfigured tools';
$string['failedtoconnect'] = 'Moodle was unable to communicate with the "{$a}" system';
$string['failedtocreatetooltype'] = 'Failed to create new tool. Please check the URL and try again.';
$string['failedtodeletetoolproxy'] = 'Failed to delete tool registration. You may need to visit "Manage external tool registrations" and delete it manually.';
$string['filter_basiclti_configlink'] = 'Configure your preferred sites and their passwords';
$string['filter_basiclti_password'] = 'Password is mandatory';
$string['filterconfig'] = 'LTI administration';
$string['filtername'] = 'LTI';
$string['fixexistingconf'] = 'Use an existing configuration for the misconfigured instance';
$string['fixnew'] = 'New configuration';
$string['fixnewconf'] = 'Define a new configuration for the misconfigured instance';
$string['fixold'] = 'Use existing';
$string['force_ssl'] = 'Force SSL';
$string['force_ssl_help'] = 'Selecting this option forces all launches to this tool provider to use SSL.

In addition, all web service requests from the tool provider will use SSL.

If using this option, confirm that this Moodle site and the tool provider support SSL.';
$string['generaltool'] = 'General tool';
$string['grading'] = 'Grade routing';
$string['icon_url'] = 'Icon URL';
$string['icon_url_help'] = 'The icon URL allows the icon that shows up in the course listing for this activity to be modified. Instead of using the default
LTI icon, an icon which conveys the type of activity may be specified.';
$string['id'] = 'ID';
$string['indicator:cognitivedepth'] = 'LTI cognitive';
$string['indicator:cognitivedepth_help'] = 'This indicator is based on the cognitive depth reached by the student in an LTI activity.';
$string['indicator:cognitivedepthdef'] = 'LTI cognitive';
$string['indicator:cognitivedepthdef_help'] = 'The participant has reached this percentage of the cognitive engagement offered by the LTI activities during this analysis interval (Levels = No view, View, Submit, View feedback)';
$string['indicator:cognitivedepthdef_link'] = 'Learning_analytics_indicators#Cognitive_depth';
$string['indicator:socialbreadth'] = 'LTI social';
$string['indicator:socialbreadth_help'] = 'This indicator is based on the social breadth reached by the student in an LTI activity.';
$string['indicator:socialbreadthdef'] = 'LTI social';
$string['indicator:socialbreadthdef_help'] = 'The participant has reached this percentage of the social engagement offered by the LTI activities during this analysis interval (Levels = No participation, Participant alone, Participant with others)';
$string['indicator:socialbreadthdef_link'] = 'Learning_analytics_indicators#Social_breadth';
$string['initiatelogin'] = 'Initiate login URL';
$string['initiatelogin_help'] = 'The tool URL to which requests for initiating a login are to be sent.  This URL is required before a message can be successfully sent to the tool.';
$string['invalidid'] = 'LTI ID was incorrect';
$string['jwtsecurity'] = 'LTI 1.3';
$string['keytype'] = 'Public key type';
$string['keytype_help'] = 'The authentication method used to validate the tool.';
$string['keytype_keyset'] = 'Keyset URL';
$string['keytype_rsa'] = 'RSA key';
$string['launch_in_moodle'] = 'Launch tool in Moodle';
$string['launch_in_popup'] = 'Launch tool in a pop-up';
$string['launch_url'] = 'Tool URL';
$string['launch_url_help'] = 'The tool URL indicates the web address of the External Tool, and may contain additional information, such as the resource to show.
If you are unsure what to enter for the tool URL, please check with the tool provider for more information.

You can enter a cartridge URL if you have one, and the rest of the form details will fill automatically.

If you have selected a preconfigured tool, you may not need to enter a tool URL. If the tool link is used to just launch
into the tool provider\'s system, and not go to a specific resource, this will likely be the case.';
$string['launchinpopup'] = 'Launch container';
$string['launchinpopup_help'] = 'The launch container affects the display of the tool when launched from the course. Some launch containers provide more screen
real estate to the tool, and others provide a more integrated feel with the Moodle environment.

* **Default** - Use the launch container specified by the tool configuration.
* **Embed** - The tool is displayed within the existing Moodle window, in a manner similar to most other Activity types.
* **Embed, without blocks** - The tool is displayed within the existing Moodle window, with just the navigation controls
        at the top of the page.
* **New window** - The tool opens in a new window, occupying all the available space.
        Depending on the browser, it will open in a new tab or a popup window.
        It is possible that browsers will prevent the new window from opening.';
$string['launchoptions'] = 'Launch options';
$string['lti'] = 'LTI';
$string['lti:addcoursetool'] = 'Add course-specific tool configurations';
$string['lti:addmanualinstanceprohibitederror'] = 'The manual creation of tools without a course tool definition is no longer supported. Please create a course tool first and then use that to create activity instances.';
$string['lti:addinstance'] = 'Add a new external tool';
$string['lti:addpreconfiguredinstance'] = 'Add a preconfigured tool';
$string['lti:grade'] = 'View grades returned by the external tool';
$string['lti:manage'] = 'Be an Instructor when the tool is launched';
$string['lti:admin'] = 'Be an administrator when the tool is launched';
$string['lti:requesttooladd'] = 'Request a tool is configured site-wide';
$string['lti:view'] = 'Launch external tool activities';
$string['ltisettings'] = 'LTI settings';
$string['lti_administration'] = 'Edit preconfigured tool';
$string['lti_errormsg'] = 'The tool returned the following error message: "{$a}"';
$string['lti_launch_error'] = 'An error occurred when launching the external tool:';
$string['lti_launch_error_tool_request'] = '<p>
To submit a request for an administrator to complete the tool configuration, click <a href="{$a->admin_request_url}" target="_top">here</a>.
</p>';
$string['lti_launch_error_unsigned_help'] = '<p>This error may be a result of a missing consumer key and shared secret for the tool provider.</p>
<p>If you have a consumer key and shared secret, you may enter it when editing the external tool instance (make sure advanced options are visible).</p>
<p>Alternatively, you may <a href="{$a->course_tool_editor}">create a course level tool provider configuration</a>.</p>';
$string['lti_tool_request_added'] = 'Tool configuration request successfully submitted. You may need to contact an administrator to complete the tool configuration.';
$string['lti_tool_request_existing'] = 'A tool configuration for the tool domain has already been submitted.';
$string['ltiunknownserviceapicall'] = 'LTI unknown service API call.';
$string['ltiversion'] = 'LTI version';
$string['ltiversion_help'] = 'The version of LTI being used for signing messages and service requests: LTI 1.0/1.1 and LTI 2.0 use the OAuth 1.0A security profile; LTI 1.3.0 uses JWTs.';
$string['main_admin'] = 'General help';
$string['main_admin_help'] = 'External tools allow Moodle users to interact with learning resources hosted remotely. Through a special launch protocol, the remote tool has access to general information about the launching user. For example, the institution name, course ID, user ID, and other information such as the user\'s name or email address.

Tools listed on this page are separated into three categories:

* **Active** - These tool providers have been approved and configured by an administrator. They can be used from within any course on this site. If a consumer key and shared secret are entered, a trust relationship is established between this site and the remote tool, providing a secure communication channel.
* **Pending** - These tool providers came in through a package import, but have not been configured by an administrator. Teachers may still use tools from these providers if they have a consumer key and shared secret, or if none is required.
* **Rejected** - These tools providers are flagged as ones which an administrator has no intention of making available on the site. Teachers may still use tools from these providers if they have a consumer key and shared secret, or if none is required.';
$string['manage_external_tools'] = 'Manage tools';
$string['manage_tools'] = 'Manage preconfigured tools';
$string['manage_tool_proxies'] = 'Manage external tool registrations';
$string['manuallyaddtype'] = 'Alternatively, you can <a href="{$a}">configure a tool manually</a>.';
$string['miscellaneous'] = 'Miscellaneous';
$string['misconfiguredtools'] = 'Misconfigured tool instances were detected';
$string['missingparameterserror'] = 'The page is misconfigured: "{$a}"';
$string['module_class_type'] = 'Moodle module type';
$string['modulename'] = 'External tool';
$string['modulename_help'] = 'The external tool activity module enables students to interact with learning resources and activities on other web sites. For example, an external tool could provide access to a new activity type or learning materials from a publisher.

To create an external tool activity, a tool provider which supports LTI (Learning Tools Interoperability) is required. A teacher can create an external tool activity or make use of a tool configured by the site administrator.

External tool activities differ from URL resources in a few ways:

* External tools are context aware i.e. they have access to information about the user who launched the tool, such as institution, course and name
* External tools support reading, updating, and deleting grades associated with the activity instance
* External tool configurations create a trust relationship between your site and the tool provider, allowing secure communication between them';
$string['modulename_link'] = 'mod/lti/view';
$string['modulename_shortcut_link'] = 'mod/lti/view/custom';
$string['modulenameplural'] = 'External tools';
$string['modulenamepluralformatted'] = 'External tools';
$string['name'] = 'Name';
$string['never'] = 'Never';
$string['new_window'] = 'New window';
$string['no_lti_configured'] = 'There are no active external tools configured.';
$string['no_lti_pending'] = 'There are no pending external tools.';
$string['no_lti_rejected'] = 'There are no rejected external tools.';
$string['no_lti_tools'] = 'There are no external tools configured.';
$string['no_tp_accepted'] = 'There are no accepted external tool registrations.';
$string['no_tp_cancelled'] = 'There are no cancelled external tool registrations.';
$string['no_tp_configured'] = 'There are no unregistered external tool registrations configured.';
$string['no_tp_pending'] = 'There are no pending external tool registrations.';
$string['no_tp_rejected'] = 'There are no rejected external tool registrations.';
$string['noattempts'] = 'No attempts have been made on this tool instance';
$string['nocourseexternaltoolsnotice'] = 'There are no LTI External tools yet.';
$string['noltis'] = 'There are no external tool instances';
$string['noprofileservice'] = 'Profile service not found';
$string['noservers'] = 'No servers found';
$string['notypes'] = 'There are currently no LTI tools set up in Moodle. Click the Install link above to add some.';
$string['noviewusers'] = 'No users were found with permissions to use this tool';
$string['oauthsecurity'] = 'LTI 1.0/1.1';
$string['optionalsettings'] = 'Optional settings';
$string['organization'] = 'Organisation details';
$string['organizationdescr'] = 'Organisation description';
$string['organizationid_default'] = 'Default organisation ID';
$string['siteid'] = 'Site ID';
$string['sitehost'] = 'Site hostname';
$string['organizationid_default_help'] = 'The default value to use for Organisation ID. Site ID identifies this installation of Moodle.';
$string['organizationidguid'] = 'Organisation ID';
$string['organizationidguid_help'] = 'A unique identifier for this Moodle instance passed to the tool as the Platform Instance GUID.

If this field is left blank, the default value will be used.';
$string['organizationurl'] = 'Organisation URL';
$string['organizationurl_help'] = 'The base URL of this Moodle instance.

If this field is left blank, a default value will be used based on the site configuration.';
$string['pagesize'] = 'Submissions shown per page';
$string['parameter'] = 'Tool parameters';
$string['parameter_help'] = 'Tool parameters are settings requested to be passed by the tool provider in the accepted tool proxy.';
$string['password'] = 'Shared secret';
$string['password_admin'] = 'Shared secret';
$string['password_admin_help'] = 'The shared secret can be thought of as a password used to authenticate access to the tool. It should be provided
along with the consumer key from the tool provider.

Tools which do not require secure communication from Moodle and do not provide additional services (such as grade reporting)
may not require a shared secret.';
$string['password_help'] = 'For pre-configured tools, it is not necessary to enter a shared secret here, as the shared secret will be
provided as part of the configuration process.

This field should be entered if creating a link to a tool provider which is not already configured.
If the tool provider is to be used more than once in this course, adding a course tool configuration is a good idea.

The shared secret can be thought of as a password used to authenticate access to the tool. It should be provided
along with the consumer key from the tool provider.

Tools which do not require secure communication from Moodle and do not provide additional services (such as grade reporting)
may not require a shared secret.';
$string['pending'] = 'Pending';
$string['pluginadministration'] = 'External tool administration';
$string['pluginname'] = 'External tool';
$string['preferheight'] = 'Preferred height';
$string['preferwidget'] = 'Prefer widget launch';
$string['preferwidth'] = 'Preferred width';
$string['press_to_submit'] = 'Press to launch this activity';
$string['privacy'] = 'Privacy';
$string['privacy:metadata:courseid'] = 'The ID of the course the user is accessing the LTI Consumer from';
$string['privacy:metadata:courseidnumber'] = 'The ID number of the course the user is accessing the LTI Consumer from';
$string['privacy:metadata:coursefullname'] = 'The fullname of the course the user is accessing the LTI Consumer from';
$string['privacy:metadata:courseshortname'] = 'The shortname of the course the user is accessing the LTI Consumer from';
$string['privacy:metadata:createdby'] = 'The user who created the record';
$string['privacy:metadata:email'] = 'The email address of the user accessing the LTI Consumer';
$string['privacy:metadata:externalpurpose'] = 'The LTI Consumer provides user information and context to the LTI Tool Provider.';
$string['privacy:metadata:firstname'] = 'The firstname of the user accessing the LTI Consumer';
$string['privacy:metadata:fullname'] = 'The fullname of the user accessing the LTI Consumer';
$string['privacy:metadata:lastname'] = 'The lastname of the user accessing the LTI Consumer';
$string['privacy:metadata:lti_submission'] = 'LTI submission';
$string['privacy:metadata:lti_submission:datesubmitted'] = 'The timestamp indicating when the submission was made';
$string['privacy:metadata:lti_submission:dateupdated'] = 'The timestamp indicating when the submission was modified';
$string['privacy:metadata:lti_submission:gradepercent'] = 'The grade for the user as a percentage';
$string['privacy:metadata:lti_submission:originalgrade'] = 'The original grade for the user';
$string['privacy:metadata:lti_submission:userid'] = 'The ID of the user who submitted for the LTI activity';
$string['privacy:metadata:lti_tool_proxies'] = 'LTI proxies';
$string['privacy:metadata:lti_tool_proxies:name'] = 'LTI proxy name';
$string['privacy:metadata:lti_types'] = 'LTI types';
$string['privacy:metadata:lti_types:name'] = 'LTI type name';
$string['privacy:metadata:role'] = 'The role in the course for the user accessing the LTI Consumer';
$string['privacy:metadata:timecreated'] = 'The time when the record was created';
$string['privacy:metadata:timemodified'] = 'The time when the record was modified';
$string['privacy:metadata:userid'] = 'The ID of the user accessing the LTI Consumer';
$string['privacy:metadata:useridnumber'] = 'The ID number of the user accessing the LTI Consumer';
$string['privacy:metadata:username'] = 'The username of the user accessing the LTI Consumer';
$string['publickey'] = 'Public key';
$string['publickeyset'] = 'Public keyset';
$string['publickeyset_help'] = 'Public keyset from where this site will retrieve the tool\'s public key to allow signatures of incoming messages and service requests to be verified.';
$string['publickey_help'] = 'The public key (in PEM format) provided by the tool to allow signatures of incoming messages and service requests to be verified.';
$string['quickgrade'] = 'Allow quick grading';
$string['quickgrade_help'] = 'If enabled, multiple tools can be graded on one page. Add grades and comments then click the "Save all my feedback" button to save all changes for that page.';
$string['redirect'] = 'You will be redirected in few seconds. If you are not, press the button.';
$string['redirectionuris'] = 'Redirection URI(s)';
$string['redirectionuris_help'] = 'A list of URIs (one per line) which the tool uses when making authorisation requests.  At least one must be registered before a message can be successfully sent to the tool.';
$string['register'] = 'Register';
$string['register_warning'] = 'The registration page seems to be taking a while to open. If it does not appear, check that you entered the correct URL in the configuration settings. If Moodle is using https, ensure the tool you are configuring supports https and you are using https in the URL.';
$string['registertype'] = 'Configure a new external tool registration';
$string['registration_options'] = 'Registration options';
$string['registrationname'] = 'Tool provider name';
$string['registrationname_help'] = 'Enter the name of the tool provider being registered.';
$string['registrationurl'] = 'Registration URL';
$string['registrationurl_help'] = 'The registration URL should be available from the tool provider as the location to which registration requests should be sent.';
$string['reject'] = 'Reject';
$string['rejected'] = 'Rejected';
$string['resource'] = 'Resource';
$string['resourcekey'] = 'Consumer key';
$string['resourcekey_admin'] = 'Consumer key';
$string['resourcekey_admin_help'] = 'The consumer key can be thought of as a username used to authenticate access to the tool.
It can be used by the tool provider to uniquely identify the Moodle site from which users launch into the tool.

The consumer key must be provided by the tool provider. The method of obtaining a consumer key varies between
tool providers. It may be an automated process, or it may require a dialogue with the tool provider.

Tools which do not require secure communication from Moodle and do not provide additional services (such as grade reporting)
may not require a resource key.';
$string['resourcekey_help'] = 'For pre-configured tools, it is not necessary to enter a resource key here, as the consumer key will be
provided as part of the configuration process.

This field should be entered if creating a link to a tool provider which is not already configured.
If the tool provider is to be used more than once in this course, adding a course tool configuration is a good idea.

The consumer key can be thought of as a username used to authenticate access to the tool.
It can be used by the tool provider to uniquely identify the Moodle site from which users launch into the tool.

The consumer key must be provided by the tool provider. The method of obtaining a consumer key varies between
tool providers. It may be an automated process, or it may require a dialogue with the tool provider.

Tools which do not require secure communication from Moodle and do not provide additional services (such as grade reporting)
may not require a resource key.';
$string['resourceurl'] = 'Resource URL';
$string['restricttocategory'] = 'Restrict to category';
$string['restricttocategory_help'] = 'To restrict use of this tool to courses within a category, select the category or categories from the list.';
$string['return_to_course'] = 'Click <a href="{$a->link}" target="_top">here</a> to return to the course.';
$string['saveallfeedback'] = 'Save all my feedback';
$string['search:activity'] = 'External tool - activity information';
$string['secure_icon_url'] = 'Secure icon URL';
$string['secure_icon_url_help'] = 'Similar to the icon URL, but used when the site is accessed securely through SSL. This field is to prevent the browser from displaying a warning about an insecure image.';
$string['secure_launch_url'] = 'Secure tool URL';
$string['secure_launch_url_help'] = 'Similar to the tool URL, but used instead of the tool URL if high security is required. Moodle will use the secure tool URL instead of the tool URL if the Moodle site is accessed through SSL, or if the tool configuration is set to always launch through SSL.

The tool URL may also be set to an https address to force launching through SSL, and this field may be left blank.';
$string['selectcontent'] = 'Select content';
$string['send'] = 'Send';
$string['services'] = 'Services';
$string['services_help'] = 'Select those services which you wish to offer to the tool provider.  More than one service can be selected.';
$string['setupoptions'] = 'Set-up options';
$string['share_email'] = 'Share launcher\'s email with the tool';
$string['share_email_admin'] = 'Share launcher\'s email with tool';
$string['share_email_admin_help'] = 'Specify whether the e-mail address of the user launching the tool will be shared with the tool provider.
The tool provider may need launcher\'s e-mail addresses to distinguish users with the same name in the UI, or send e-mails
to users based on actions within the tool.';
$string['share_email_help'] = 'Specify whether the e-mail address of the user launching the tool will be shared with the tool provider.

The tool provider may need launcher\'s email addresses to distinguish users with the same name, or send emails to users based on actions within the tool.

Note that this setting may be overridden in the tool configuration.';
$string['share_name'] = 'Share launcher\'s name with the tool';
$string['share_name_admin'] = 'Share launcher\'s name with tool';
$string['share_name_admin_help'] = 'Specify whether the full name of the user launching the tool should be shared with the tool provider.
The tool provider may need launchers\' names to show meaningful information within the tool.';
$string['share_name_help'] = 'Specify whether the full name of the user launching the tool should be shared with the tool provider.

The tool provider may need launchers\' names to show meaningful information within the tool.

Note that this setting may be overridden in the tool configuration.';
$string['share_roster'] = 'Allow the tool to access this course\'s roster';
$string['share_roster_admin'] = 'Tool may access course roster';
$string['share_roster_admin_help'] = 'Specify whether the tool can access the list of users enrolled in courses from which this tool is launched.';
$string['share_roster_help'] = 'Specify whether the tool can access the list of users enrolled in this course.

Note that this setting may be overridden in the tool configuration.';
$string['show_in_course_activity_chooser'] = 'Show in activity chooser and as a preconfigured tool';
$string['showinactivitychooser'] = 'Show in activity chooser';
$string['dontshowinactivitychooser'] = 'Don\'t show in activity chooser';
$string['show_in_course_lti1'] = 'Tool configuration usage';
$string['show_in_course_lti1_help'] = 'This tool may be shown in the activity chooser for a teacher to select to add to a course. Alternatively, it may be shown in the preconfigured tool drop-down menu when adding an external tool to a course. A further option is for the tool configuration to only be used if the exact tool URL is entered when adding an external tool to a course.';
$string['show_in_course_lti2'] = 'Tool configuration usage';
$string['show_in_course_lti2_help'] = 'This tool can be shown in the activity chooser for a teacher to select to add to a course or in the preconfigured tool drop-down menu when adding an external tool to a course.';
$string['show_in_course_no'] = 'Do not show; use only when a matching tool URL is entered';
$string['show_in_course_preconfigured'] = 'Show as preconfigured tool when adding an external tool';
$string['size'] = 'Size parameters';
$string['opensslconfiginvalid'] = 'LTI 1.3 requires a valid openssl.cnf to be configured and available to your web server. Please contact the site administrator to configure and enable openssl for this site.';
$string['submission'] = 'Submission';
$string['submissions'] = 'Submissions';
$string['submissionsfor'] = 'Submissions for {$a}';
$string['successfullycreatedtooltype'] = 'Successfully created new tool!';
$string['successfullyfetchedtoolconfigurationfromcontent'] = 'Successfully fetched tool configuration from the selected content.';
$string['subplugintype_ltiresource'] = 'LTI service resource';
$string['subplugintype_ltiresource_plural'] = 'LTI service resources';
$string['subplugintype_ltiservice'] = 'LTI service';
$string['subplugintype_ltiservice_plural'] = 'LTI services';
$string['subplugintype_ltisource'] = 'LTI source';
$string['subplugintype_ltisource_plural'] = 'LTI sources';
$string['toggle_debug_data'] = 'Toggle debug data';
$string['tool_settings'] = 'Tool settings';
$string['tooldescription'] = 'Tool description';
$string['tooldescription_help'] = 'The description of the tool that will be displayed to teachers in the activity list.

This should describe what the tool is for and what it does and any additional information the teacher may need to know.';
$string['tooldetailsaccesstokenurl'] = 'Access token URL';
$string['tooldetailsauthrequesturl'] = 'Authentication request URL';
$string['tooldetailsclientid'] = 'Client ID';
$string['tooldetailsdeploymentid'] = 'Deployment ID';
$string['tooldetailsmailtosubject'] = 'LTI tool configuration';
$string['tooldetailsmodalemail'] = 'Email';
$string['tooldetailsmodallink'] = 'View configuration details';
$string['tooldetailsmodaltitle'] = 'Tool configuration details';
$string['tooldetailsplatformid'] = 'Platform ID';
$string['tooldetailspublickeyseturl'] = 'Public keyset URL';
$string['toolisbeingused'] = 'This tool is being used {$a} times';
$string['toolisnotbeingused'] = 'This tool has not yet been used';
$string['toolproxy'] = 'External tool registrations';
$string['toolproxy_help'] = 'External tool registrations allow Moodle site administrators to configure external tools from a tool proxy obtained from a tool provider supporting LTI 2.0. A registration URL provided by the tool provider is all that is required to initiate the process. The capabilities and services offered to the tool provider are selected when configuring a new registration.

Tool registrations listed on this page are separated into four categories:

* **Configured** - These tool registrations have been set up but the registration process has not yet been started.
* **Pending** - The registration process for these tool registrations has been started but has not completed. Open and save the settings to move it
back to the \'Configured\' category.
* **Accepted** - These tool registrations have been approved; the resources specified in the tool proxy will appear on the preconfigured tools page
with an initial status of \'Pending\'.
* **Rejected** - These tool registrations are ones which were rejected during the registration process. Open and save the settings to move it
back to the \'Configured\' category so the registration process can be restarted.';
$string['toolproxyregistration'] = 'External tool registration';
$string['toolregistration'] = 'External tool registration';
$string['toolsetup'] = 'External tool configuration';
$string['tooltypenotfounderror'] = "The LTI tool used in this activity has been deleted. If you need help, contact your teacher or site administrator.";
$string['tooltypes'] = 'Tools';
$string['toolurl'] = 'Tool URL';
$string['toolurlplaceholder'] = 'Tool URL...';
$string['toolurl_help'] = 'The tool URL is used to match tool URLs to the correct tool configuration. Prefixing the URL with http(s) is optional.

Additionally, the base URL is used as the tool URL if a tool URL is not specified in the external tool instance.

For example, a base URL of *tool.com* would match the following:

* tool.com
* tool.com/quizzes
* tool.com/quizzes/quiz.php?id=10
* www.tool.com/quizzes

A base URL of *www.tool.com/quizzes* would match the following:

* www.tool.com/quizzes
* tool.com/quizzes
* tool.com/quizzes/take.php?id=10

A base URL of *quiz.tool.com* would match the following:

* quiz.tool.com
* quiz.tool.com/take.php?id=10

If two different tool configurations are for the same domain, the most specific match will be used.

You can also insert a cartridge URL if you have one and the details for the tool will be automatically filled.';
$string['toolurl_contentitemselectionrequest'] = 'Content Selection URL';
$string['toolurl_contentitemselectionrequest_help'] = 'The Content Selection URL will be used to launch the content selection page from the tool provider. If it is empty, the Tool URL will be used';
$string['typename'] = 'Tool name';
$string['typename_help'] = 'The tool name is used to identify the tool provider within Moodle. The name entered will be visible to teachers when adding external tools within courses.';
$string['types'] = 'Types';
$string['unabletocreatetooltype'] = 'Unable to create tool';
$string['unabletofindtooltype'] = 'Unable to find tool for {$a->id}';
$string['unknownstate'] = 'Unknown state';
$string['update'] = 'Update';
$string['usage'] = 'Usage count';
$string['useraccountinformation'] = 'User account information';
$string['userpersonalinformation'] = 'User personal information';
$string['validurl'] = 'A valid URL must start with http(s)://';
$string['viewsubmissions'] = 'View submissions and grading screen';

// Deprecated since Moodle 4.5.
$string['selectcontentvalidationerror'] = 'You need to select content for this activity.';
