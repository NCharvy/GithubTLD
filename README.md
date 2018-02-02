# TLD Interview Test

## Introduction

You have 2 hours to create a small symfony app parsing data from the Github API.
You're free to use any solution to run & serve the app (the Symfony PHP Web server, docker + nginx/apache, ...).

## Goals

* Your code must be tested using PHPUnit
* Create a new Symfony Applicationiss
* Using this documentation: https://developer.github.com/v3/repos/commits/, retrieve commits made between two dates from Github API on a repository.
* Create a symfony action matching this pattern /{user}/{repository} and process the data from the API to count and list commits made for each calendar weeks.
* Two optional parameters should be accepted and processed by this route: since and until. Their default values should be 6 months ago and today.
* The response of this controller should be a valid JSON response with appropriate HTTP headers. Here is a sample element of this collection:
```json
{
    "year": 2017,
    "week": 25,
    "count": 5,
    "commits": [
        // add here the 5 commit objects retrieved from github
    ]
}
```

## Instructions

* You are allowed to install any dependencies you need with composer.
* Your code must be versioned using git, you can either provide a zip archive with the .git folder or a github repository url.
* You're free to use Symfony 3 or 4.
* If you don't have enough time to do every necessary tasks, please specify what you could have done to accomplish the missing parts.
