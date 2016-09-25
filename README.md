# SkipTheBS Server
Server side code for [SkipTheBS](https://github.com/girst/SkipTheBS-Client), a Firefox and Chromium extension to skip 'sponsorships' in YouTube videos.

## Requirements
This Application mainly runs on the LAMP stack. PHP 5.6+, Apache Webserver and MySQL should suffice.

## Installation
To install SkipTheBS-Server follow these steps:
1. Clone this repository into your web root directory.
2. Change your Apache `DocumentRoot` directory to the `public` directory.
3. Import the `.sql` files from the `install` directory into your MySQL installation.
... And you're done!

## Usage

### Submitting section data
To submit data you first pass `submit` as GET parameter along with your custom data. This should normally only be done by the extension. 
`skipthebs.php?submit&start_time=00:00:22&stop_time=00:00:29&section_type=advertisement&video_code=VdJdHf8BscM`. 
A new video will be inserted if the `video_code` passed as parameter doesn't already exist as a video in the database.

### Requesting section data
Requesting data is even easier. You just pass `request` along with the `video_code`. 

`skipthebs.php?request_sections&video_code=VdJdHf8BscM`

### Requesting section types
This is an IMO interesting feature for frontend devs. You can request all section types for the frontend so people can choose what types of sections they want to skip (intros, ads, etc.).

`skipthebs.php?request_sectypes`

### Extending the service
The application does not currently have an easy-to-use backend for administrators. So for example if you want to add a new section type, you'll have to manually execute an insert query.
