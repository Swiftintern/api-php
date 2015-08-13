# Swiftintern PHP API

Assists you to programmatically create, edit and delete Opportunity on Instamojo in PHP.


## Usage

### Create a Link

    <?php
    require "swiftintern.php";

    $api = new Swiftintern();
    $response = $api->opportunityList();
    print_r($response);
    ?>

This will give you JSON object containing details of the Link that was just created.

## Available Functions

You have these functions to interact with the API:

  * `opportunityList()` List all opportunities.
  * `opportunityDetail($id)` Get details of opportunity specified by its unique id.