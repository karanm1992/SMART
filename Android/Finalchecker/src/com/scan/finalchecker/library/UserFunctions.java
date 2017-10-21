
package com.scan.finalchecker.library;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

public class UserFunctions {
	
	private JSONParser jsonParser;
	
	private static String loginURL = "http://metropune.atwebpages.com/new/scanner/test.php";
	
	// constructor
	public UserFunctions(){
		jsonParser = new JSONParser();
	}
	
	/**
	 * function make Login Request
	 * @param email
	 * @param password
	 * */
	
	public JSONObject check(String ticket){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("det", ticket));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	
	
	
	
}
