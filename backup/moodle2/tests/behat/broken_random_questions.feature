@core @core_backup
Feature: Broken random questions don't grow exponentially when a quiz is duplicated

  Background:
    Given the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1        | 0        |
    And the following config values are set as admin:
      | enableasyncbackup | 0 |

  @javascript @_file_upload
  Scenario: Broken random questions don't grow exponentially when a quiz is duplicated
    Given I am on the "Course 1" "restore" page logged in as "admin"
    And I press "Manage course backups"
    And I upload "backup/moodle2/tests/fixtures/broken_question_course.mbz" file to "Files" filemanager
    And I press "Save changes"
    And I restore "broken_question_course.mbz" backup into a new course using this options:
    And I navigate to "Plugins > Manage question types" in site administration
    And "Random" row "No. questions" column of "qtypes" table should contain "1"
    When I am on "Broken Question Course" course homepage with editing mode on
    And I duplicate "Broken question quiz" activity
    And I navigate to "Plugins > Manage question types" in site administration
    Then "Random" row "No. questions" column of "qtypes" table should contain "1"
