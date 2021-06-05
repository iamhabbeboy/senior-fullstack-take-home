from flask import Flask
from flask import request
from flask import json
from lib.interview_soap_client import InterviewSoapClient

app = Flask(__name__)


@app.route("/")
def index():
    return "Congratulations, lets get started!"


@app.route("/soap")
def soap():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='helloFromPHP',
    )

    return res


@app.route("/company")
def company():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='getCompanyById',
        args={'id': 1}
    )

    return res

@app.route('/webhook', methods=['POST'])
def webhook():
    if request.headers['Content-Type'] == 'application/json':
        response = json.dumps(request.json)
        get_issue = response.issue.body
        print(get_issue)
        return response