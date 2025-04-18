@editor @editor_tiny @tiny_link
Feature: Add links to TinyMCE
  To write rich text - I need to add links.

  @javascript
  Scenario: Insert a link
    Given the following "user private file" exists:
      | user     | admin                                                |
      | filepath | lib/editor/tiny/tests/behat/fixtures/moodle-logo.png |
    And I log in as "admin"
    And I open my profile in edit mode
    And I set the field "Description" to "Super cool"
    When I select the "p" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Link" button for the "Description" TinyMCE editor
    Then the field "Text to display" matches value "Super cool"
    And I click on "Browse repositories..." "button" in the "Create link" "dialogue"
    And I select "Private files" repository in file picker
    And I click on "moodle-logo.png" "link"
    And I click on "Select this file" "button"
    And I click on "Update profile" "button"
    And I follow "Preferences" in the user menu
    And I follow "Editor preferences"
    And I set the field "Text editor" to "Plain text area"
    And I press "Save changes"
    And I click on "Edit profile" "link" in the "region-main" "region"
    And I should see "Super cool</a>"

  @javascript
  Scenario: Insert a link without providing text to display
    Given I log in as "admin"
    When I open my profile in edit mode
    And I click on the "Link" button for the "Description" TinyMCE editor
    And I set the field "URL" to "https://moodle.org/"
    Then the field "Text to display" matches value "https://moodle.org/"
    And I click on "Create link" "button" in the "Create link" "dialogue"
    And the field "Description" matches value "<p><a href=\"https://moodle.org/\">https://moodle.org/</a></p>"
    And I select the "a" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Link" button for the "Description" TinyMCE editor
    And the field "Text to display" matches value "https://moodle.org/"
    And the field "URL" matches value "https://moodle.org/"
    And I click on "Close" "button" in the "Create link" "dialogue"

  @javascript
  Scenario: Insert a link with providing text to display
    Given I log in as "admin"
    When I open my profile in edit mode
    And I click on "Link" "button"
    And I set the field "Text to display" to "Moodle - Open-source learning platform"
    And I set the field "Enter a URL" to "https://moodle.org/"
    And I click on "Create link" "button" in the "Create link" "dialogue"
    Then the field "Description" matches value "<p><a href=\"https://moodle.org/\">Moodle - Open-source learning platform</a></p>"
    And I select the "a" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Link" button for the "Description" TinyMCE editor
    And the field "Text to display" matches value "Moodle - Open-source learning platform"
    And the field "Enter a URL" matches value "https://moodle.org/"
    And I click on "Close" "button" in the "Create link" "dialogue"

  @javascript
  Scenario: Edit a link that already had a custom text to display
    Given I log in as "admin"
    And I follow "Preferences" in the user menu
    And I follow "Editor preferences"
    And I set the field "Text editor" to "Plain text area"
    And I press "Save changes"
    And I click on "Edit profile" "link" in the "region-main" "region"
    And I set the field "Description" to "<a href=\"https://moodle.org/\">Moodle - Open-source learning platform</a>"
    And I click on "Update profile" "button"
    And I follow "Preferences" in the user menu
    And I follow "Editor preferences"
    And I set the field "Text editor" to "TinyMCE editor"
    And I press "Save changes"
    When I click on "Edit profile" "link" in the "region-main" "region"
    Then the field "Description" matches value "<p><a href=\"https://moodle.org/\">Moodle - Open-source learning platform</a></p>"
    And I select the "a" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Link" button for the "Description" TinyMCE editor
    And the field "Text to display" matches value "Moodle - Open-source learning platform"
    And the field "Enter a URL" matches value "https://moodle.org/"

  @javascript
  Scenario: Insert and update link in the TinyMCE editor
    Given I log in as "admin"
    When I open my profile in edit mode
    And I click on "Link" "button"
    And I set the field "Text to display" to "Moodle - Open-source learning platform"
    And I set the field "Enter a URL" to "https://moodle.org/"
    And I click on "Create link" "button" in the "Create link" "dialogue"
    Then the field "Description" matches value "<p><a href=\"https://moodle.org/\">Moodle - Open-source learning platform</a></p>"
    And I select the "a" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Link" button for the "Description" TinyMCE editor
    And the field "Text to display" matches value "Moodle - Open-source learning platform"
    And the field "Enter a URL" matches value "https://moodle.org/"
    And I set the field "Enter a URL" to "https://moodle.com/"
    And "Create link" "button" should not exist in the "Create link" "dialogue"
    And "Update link" "button" should exist in the "Create link" "dialogue"
    And I click on "Update link" "button" in the "Create link" "dialogue"
    And the field "Description" matches value "<p><a href=\"https://moodle.com/\">Moodle - Open-source learning platform</a></p>"

  @javascript
  Scenario: Insert a link for an image using TinyMCE editor
    Given the following "user private file" exists:
      | user     | admin                                                |
      | filepath | lib/editor/tiny/tests/behat/fixtures/moodle-logo.png |
    And I log in as "admin"
    And I open my profile in edit mode
    And I click on the "Image" button for the "Description" TinyMCE editor
    And I click on "Browse repositories" "button" in the "Insert image" "dialogue"
    And I select "Private files" repository in file picker
    And I click on "moodle-logo.png" "link"
    And I click on "Select this file" "button"
    And I set the field "How would you describe this image to someone who can't see it?" to "It's the Moodle"
    And I click on "Save" "button" in the "Image details" "dialogue"
    And I select the "img" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Link" button for the "Description" TinyMCE editor
    And I set the field "Enter a URL" to "https://moodle.org/"
    And I set the field "Text to display" to "Moodle - Open-source learning platform"
    And I click on "Update link" "button" in the "Create link" "dialogue"
    # TODO: Verify the HTML by the improved code plugin in MDL-75265
    And I click on "Update profile" "button"
    And I follow "Preferences" in the user menu
    And I follow "Editor preferences"
    And I set the field "Text editor" to "Plain text area"
    And I press "Save changes"
    When I click on "Edit profile" "link" in the "region-main" "region"
    Then I should see "<a title=\"Moodle - Open-source learning platform\" href=\"https://moodle.org/\"><img"
    And I follow "Preferences" in the user menu
    And I follow "Editor preferences"
    And I set the field "Text editor" to "TinyMCE editor"
    And I press "Save changes"
    And I click on "Edit profile" "link" in the "region-main" "region"
    And I select the "img" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Image" button for the "Description" TinyMCE editor
    And the field "How would you describe this image to someone who can't see it?" matches value "It's the Moodle"
    And I click on "Close" "button" in the "Image details" "dialogue"
    And I click on the "Link" button for the "Description" TinyMCE editor
    And the field "Text to display" matches value "Moodle - Open-source learning platform"
    And the field "Enter a URL" matches value "https://moodle.org/"

  @javascript
  Scenario: Unset a link
    Given I log in as "admin"
    And I follow "Preferences" in the user menu
    And I follow "Editor preferences"
    And I set the field "Text editor" to "Plain text area"
    And I press "Save changes"
    And I click on "Edit profile" "link" in the "region-main" "region"
    And I set the field "Description" to "<a href=\"https://moodle.org/\">Moodle - Open-source learning platform</a>"
    And I click on "Update profile" "button"
    And I follow "Preferences" in the user menu
    And I follow "Editor preferences"
    And I set the field "Text editor" to "TinyMCE editor"
    And I press "Save changes"
    And I click on "Edit profile" "link" in the "region-main" "region"
    And I select the "a" element in position "0" of the "Description" TinyMCE editor
    When I click on the "Unlink" button for the "Description" TinyMCE editor
    Then the field "Description" matches value "<p>Moodle - Open-source learning platform</p>"

  @javascript
  Scenario: Permissions can be configured to control access to link
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | 1        | teacher1@example.com |
      | teacher2 | Teacher   | 2        | teacher2@example.com |
    And the following "courses" exist:
      | fullname | shortname | format |
      | Course 1 | C1        | topics |
    And the following "roles" exist:
      | name           | shortname | description         | archetype      |
      | Custom teacher | custom1   | Limited permissions | editingteacher |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | teacher2 | C1     | custom1        |
    And the following "activity" exists:
      | activity | assign          |
      | course   | C1              |
      | name     | Test assignment |
    And the following "permission overrides" exist:
      | capability    | permission | role    | contextlevel | reference |
      | tiny/link:use | Prohibit   | custom1 | Course       | C1        |
    # Check plugin access as a role with prohibited permissions.
    And I log in as "teacher2"
    And I am on the "Test assignment" Activity page
    And I navigate to "Settings" in current page administration
    When I click on the "Insert" menu item for the "Activity instructions" TinyMCE editor
    Then I should not see "Link"
    # Check plugin access as a role with allowed permissions.
    And I log in as "teacher1"
    And I am on the "Test assignment" Activity page
    And I navigate to "Settings" in current page administration
    And I click on the "Insert" menu item for the "Activity instructions" TinyMCE editor
    And I should see "Link"
