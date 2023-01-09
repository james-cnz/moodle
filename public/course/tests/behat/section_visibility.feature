@core @core_course @_cross_browser
Feature: Show/hide course sections
  In order to delay sections availability
  As a teacher
  I need to show or hide sections

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher1@example.com |
      | student1 | Student | 1 | student1@example.com |
    And the following "course" exists:
      | fullname         | Course 1 |
      | shortname        | C1       |
      | format           | topics   |
      | hiddensections   | 0        |
      | enablecompletion | 1        |
      | coursedisplay    | 1        |
      | initsections     | 1        |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
      | student1 | C1 | student |
    And the following "activities" exist:
      | activity | course | section | name                      | visible |
      | forum    | C1     | 1       | Test hidden forum 11 name | 0       |
      | forum    | C1     | 1       | Test hidden forum 12 name | 1       |
      | forum    | C1     | 2       | Test hidden forum 21 name | 0       |
      | forum    | C1     | 2       | Test hidden forum 22 name | 1       |
      | forum    | C1     | 3       | Test hidden forum 31 name | 0       |
      | forum    | C1     | 3       | Test hidden forum 32 name | 1       |
    And I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on

  @javascript
  Scenario: Show / hide section icon functions correctly
    When I hide section "1"
    Then section "1" should be hidden
    And section "2" should be visible
    And section "3" should be visible
    And I hide section "2"
    And section "2" should be hidden
    And I show section "2"
    And section "2" should be visible
    And I hide section "3"
    And I show section "3"
    And I hide section "3"
    And section "3" should be hidden
    And I reload the page
    And section "1" should be hidden
    And all activities in section "1" should be hidden
    And section "2" should be visible
    And section "3" should be hidden
    And all activities in section "1" should be hidden
    And I am on the "Course 1" course page logged in as student1
    And section "1" should be hidden
    And all activities in section "1" should be hidden
    And section "2" should be visible
    And section "3" should be hidden
    And all activities in section "1" should be hidden

  @javascript
  Scenario: Students can not navigate to hidden sections
    Given I hide section "2"
    And I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Course layout | Show one section per page |
    And I press "Save and display"
    When I click on "Section 1" "link" in the "region-main" "region"
    Then I should see "Section 2" in the "region-main" "region"
    And I click on "Section 2" "link" in the "region-main" "region"
    And I should see "Section 1" in the "region-main" "region"
    And I should see "Section 3" in the "region-main" "region"
    And I am on the "Course 1" course page logged in as student1
    And I click on "Section 1" "link" in the "region-main" "region"
    And I should not see "Section 2" in the "region-main" "region"
    And I should see "Section 3" in the "region-main" "region"
    And I click on "Section 3" "link" in the "region-main" "region"
    And I should not see "Section 2" in the "region-main" "region"
    And I should see "Section 1" in the "region-main" "region"

  @javascript
  Scenario: Students can not navigate to restricted sections
    Given the following "activities" exist:
      | activity | course | section | name       | completion |
      | label    | C1     | 1       | Test label | 1          |
    And I edit the section "2"
    And I expand all fieldsets
    And I click on "Add restriction..." "button"
    And I click on "Activity completion" "button" in the "Add restriction..." "dialogue"
    And I set the following fields to these values:
      | cm | Test label |
      | Required completion status | must be marked complete |
    And I press "Save changes"
    When I click on "Section 1" "link" in the "region-main" "region"
    Then I should see "Section 2" in the "region-main" "region"
    And I click on "Section 2" "link" in the "region-main" "region"
    And I should see "Section 1" in the "region-main" "region"
    And I should see "Section 3" in the "region-main" "region"
    And I am on the "Course 1" course page logged in as student1
    And I click on "Section 1" "link" in the "region-main" "region"
    And I should not see "Section 2" in the "region-main" "region"
    And I should see "Section 3" in the "region-main" "region"
    And I click on "Section 3" "link" in the "region-main" "region"
    And I should not see "Section 2" in the "region-main" "region"
    And I should see "Section 1" in the "region-main" "region"

  @javascript
  Scenario: Students can not see fully restricted sections, regardless of whether they are hidden
    Given I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Course layout | Show all sections on one page |
    And I press "Save and display"
    # Fully restrict the section
    And I am on "Course 1" course homepage with editing mode on
    And the following "activities" exist:
      | activity | course | section | name       | completion |
      | label    | C1     | 1       | Test label | 1          |
    And I edit the section "2"
    And I expand all fieldsets
    And I click on "Add restriction..." "button"
    And I click on "Activity completion" "button" in the "Add restriction..." "dialogue"
    And I set the following fields to these values:
      | cm | Test label |
      | Required completion status | must be marked complete |
    And I click on ".availability-item .availability-eye[title$=' Click to hide']" "css_element"
    And I press "Save changes"
    And I log out
    # Check fully restricted and unhidden
    When I am on the "Course 1" course page logged in as student1
    Then I should not see "Section 2" in the "region-main" "region"
    And I should not see "Not available" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"
    And I log out
    # Check fully restricted and partly hidden
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I hide section "2"
    And I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Hidden sections | Hidden sections are shown as not available |
    And I press "Save and display"
    And I log out
    When I am on the "Course 1" course page logged in as student1
    Then I should not see "Section 2" in the "region-main" "region"
    And I should not see "Not available" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"
    And I log out
    # Check fully restricted and fully hidden
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Hidden sections | Hidden sections are completely invisible |
    And I press "Save and display"
    And I log out
    When I am on the "Course 1" course page logged in as student1
    Then I should not see "Section 2" in the "region-main" "region"
    And I should not see "Not available" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"

  @javascript
  Scenario: Students can not see fully hidden sections, regardless of whether they are partly restricted
    Given I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Course layout | Show all sections on one page |
    And I press "Save and display"
    # Fully hide the section
    And I am on "Course 1" course homepage with editing mode on
    And I hide section "2"
    And I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Hidden sections | Hidden sections are completely invisible |
    And I press "Save and display"
    And I log out
    # Check fully hidden and unrestricted
    When I am on the "Course 1" course page logged in as student1
    Then I should not see "Section 2" in the "region-main" "region"
    And I should not see "Not available" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"
    And I log out
    # Check fully hidden and partly restricted
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And the following "activities" exist:
      | activity | course | section | name       | completion |
      | label    | C1     | 1       | Test label | 1          |
    And I edit the section "2"
    And I expand all fieldsets
    And I click on "Add restriction..." "button"
    And I click on "Activity completion" "button" in the "Add restriction..." "dialogue"
    And I set the following fields to these values:
      | cm | Test label |
      | Required completion status | must be marked complete |
    And I press "Save changes"
    And I log out
    When I am on the "Course 1" course page logged in as student1
    Then I should not see "Section 2" in the "region-main" "region"
    And I should not see "Not available" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"

  @javascript
  Scenario: Students can partly see partly restricted sections, regardless of whether they are partly hidden
    Given I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Course layout | Show all sections on one page |
    And I press "Save and display"
    # Partly restrict the section
    And the following "activities" exist:
      | activity | course | section | name       | completion |
      | label    | C1     | 1       | Test label | 1          |
    And I edit the section "2"
    And I expand all fieldsets
    And I click on "Add restriction..." "button"
    And I click on "Activity completion" "button" in the "Add restriction..." "dialogue"
    And I set the following fields to these values:
      | cm | Test label |
      | Required completion status | must be marked complete |
    And I press "Save changes"
    And I log out
    # Check partly restricted and unhidden
    When I am on the "Course 1" course page logged in as student1
    Then I should see "Section 2" in the "region-main" "region"
    And I should see "Not available unless: The activity Test label is marked complete" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"
    And I log out
    # Check partly restricted and partly hidden
    Given I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I hide section "2"
    And I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Hidden sections | Hidden sections are shown as not available |
    And I press "Save and display"
    When I am on the "Course 1" course page logged in as student1
    Then I should see "Section 2" in the "region-main" "region"
    And I should see "Not available" in the "region-main" "region"
    And I should not see "Not available unless: The activity Test label is marked complete" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"

  @javascript
  Scenario: Students can partly see partly hidden unrestricted sections
    Given I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Course layout | Show all sections on one page |
    And I press "Save and display"
    And I am on "Course 1" course homepage with editing mode on
    And I hide section "2"
    And I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Hidden sections | Hidden sections are shown as not available |
    And I press "Save and display"
    When I am on the "Course 1" course page logged in as student1
    Then I should see "Section 2" in the "region-main" "region"
    And I should see "Not available" in the "region-main" "region"
    And I should not see "Test hidden forum 22 name" in the "region-main" "region"

  @javascript
  Scenario: Students can fully see unrestricted unhidden sections
    Given I navigate to "Settings" in current page administration
    And I set the following fields to these values:
      | Course layout | Show all sections on one page |
    And I press "Save and display"
    And I log out
    When I am on the "Course 1" course page logged in as student1
    Then I should see "Section 2" in the "region-main" "region"
    And I should not see "Not available" in the "region-main" "region"
    And I should see "Test hidden forum 22 name" in the "region-main" "region"
