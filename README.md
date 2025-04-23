<h1> CAMPAIGN MANAGEMENT </h1>

<p> This project is about the management of different campaigns that are created by users. By using this application we can list of campaings, delete the campaign(HARD delete), update the campaing and create a campaign. </p>

<h3>Project installation</h3>
<ul>
    <li>Clone the project using <a>https://github.com/prasanthkaki/campaign-module.git</a></li>
    <li>make a .env file from .env.example file</li>
    <li>Make the database with name campaign and update the details like host, port of the database in the .env file</li>
    <li>install the composer (composer install)</li>
    <li>Run the command <b>php artisan migrate</b> </li>
    <li>use the localstack for the queue creation and sending the messages. I have mentioned the detail of the queue in the .env.example</li>
<ul>

<p>I am providing the post collection JSON object below, where we can find all the apis and implementation. I have used basic token mechanism for all the APIs.</p>

{
	"info": {
		"_postman_id": "bcf3e9a1-7802-4266-84f4-ea07d4bb23cd",
		"name": "Campaign",
		"schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json",
		"_exporter_id": "23895341"
	},
	"item": [
		{
			"name": "Create Campaign",
			"request": {
				"auth": {
					"type": "noauth"
				},
				"method": "POST",
				"header": [
					{
						"key": "token",
						"value": "1q2w3e4r5t6y",
						"type": "text"
					}
				],
				"body": {
					"mode": "raw",
					"raw": "{\r\n    \"title\": \"Campaign 1\",\r\n    \"description\": \"This Campaign is all about the wellness of the user.\",\r\n    \"targetLink\": \"https://google.com\",\r\n    \"scheduleDate\": \"2025-04-23\"\r\n}",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://127.0.0.1:8000/api/campaigns",
					"protocol": "http",
					"host": [
						"127",
						"0",
						"0",
						"1"
					],
					"port": "8000",
					"path": [
						"api",
						"campaigns"
					]
				}
			},
			"response": []
		},
		{
			"name": "Update Campaign",
			"request": {
				"auth": {
					"type": "noauth"
				},
				"method": "PUT",
				"header": [
					{
						"key": "token",
						"value": "1q2w3e4r5t6y",
						"type": "text"
					}
				],
				"body": {
					"mode": "raw",
					"raw": "{\r\n    \"title\": \"Campaign 1\",\r\n    \"description\": \"This Campaign is all about the wellness of the user.\",\r\n    \"targetLink\": \"https://google.com\",\r\n    \"scheduleDate\": \"2025-04-23\",\r\n    \"campaignId\" : \"1\"\r\n}",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://127.0.0.1:8000/api/campaign",
					"protocol": "http",
					"host": [
						"127",
						"0",
						"0",
						"1"
					],
					"port": "8000",
					"path": [
						"api",
						"campaign"
					]
				}
			},
			"response": []
		},
		{
			"name": "Share Campaign",
			"request": {
				"auth": {
					"type": "noauth"
				},
				"method": "POST",
				"header": [
					{
						"key": "token",
						"value": "1q2w3e4r5t6y",
						"type": "text"
					}
				],
				"url": {
					"raw": "http://127.0.0.1:8000/api/campaigns/1/share",
					"protocol": "http",
					"host": [
						"127",
						"0",
						"0",
						"1"
					],
					"port": "8000",
					"path": [
						"api",
						"campaigns",
						"1",
						"share"
					]
				}
			},
			"response": []
		},
		{
			"name": "Campaign List",
			"request": {
				"auth": {
					"type": "noauth"
				},
				"method": "GET",
				"header": [
					{
						"key": "token",
						"value": "1q2w3e4r5t6y",
						"type": "text"
					}
				],
				"url": {
					"raw": "http://127.0.0.1:8000/api/campaigns",
					"protocol": "http",
					"host": [
						"127",
						"0",
						"0",
						"1"
					],
					"port": "8000",
					"path": [
						"api",
						"campaigns"
					]
				}
			},
			"response": []
		}
	]
}