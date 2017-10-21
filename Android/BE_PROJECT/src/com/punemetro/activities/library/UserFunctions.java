
package com.punemetro.activities.library;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import android.content.Context;

public class UserFunctions {
	
	private JSONParser jsonParser;
	
	private static String loginURL = "http://metropune.atwebpages.com/new/android_login_api/";
	private static String registerURL = "http://metropune.atwebpages.com/new/android_login_api/";
	private static String routeURL = "http://metropune.atwebpages.com/new/routing/";
	private static String imggenURL = "http://metropune.atwebpages.com/new/phpqrcode/new.php";
	private static String chngtURL = "http://metropune.atwebpages.com/new/android_login_api/test.php";
	
	private static String login_tag = "login";
	private static String register_tag = "register";
	private static String data_tag = "data";
	private static String route_tag = "rtt";
	private static String edit_tag = "edit";
	private static String chp_tag = "chngpass";
	private static String update_tag = "update";
	private static String img_tag = "update";
	private static String cost_tag = "cost";
	private static String time_tag = "time";
	private static String detail_tag = "details";
	private static String tcount_tag = "count";
	private static String d_tag = "data";
	private static String delete_tag = "delete";
	private static String paid_tag = "paid";
	private static String uptime_tag = "chngt";
	private static String uppay_tag = "done";
	private static String dd_tag = "mydetails";
	// constructor
	public UserFunctions(){
		jsonParser = new JSONParser();
	}
	
	/**
	 * function make Login Request
	 * @param email
	 * @param password
	 * */
	public JSONObject loginUser(String mobileno, String password){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", login_tag));
		params.add(new BasicNameValuePair("mobile", mobileno));
		params.add(new BasicNameValuePair("password", password));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		// return json
		// Log.e("JSON", json.toString());
		return json;
	}
	
	public JSONObject mydetails(String mobileno,String tno)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", dd_tag));
		params.add(new BasicNameValuePair("mobile", mobileno));
		params.add(new BasicNameValuePair("tno", tno));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	public JSONObject getcount(String mobileno)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", tcount_tag));
		params.add(new BasicNameValuePair("mobile", mobileno));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	
	public JSONObject makepayment(String mobileno)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", uppay_tag));
		params.add(new BasicNameValuePair("mobile", mobileno));
		@SuppressWarnings("unused")
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return null;
		
	}
	
	public JSONObject chck_paid(String mobileno)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", paid_tag));
		params.add(new BasicNameValuePair("mobile", mobileno));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	
	public JSONObject getdata()
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", data_tag));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	
	public JSONObject stations()
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", d_tag));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
	}
	
	public JSONObject route(String src,String dest,String mobilen)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", route_tag));
		params.add(new BasicNameValuePair("src", src));
		params.add(new BasicNameValuePair("dest", dest));
		params.add(new BasicNameValuePair("mobile", mobilen));
		JSONObject json = jsonParser.getJSONFromUrl(routeURL, params);
		//return json;
		return json;
		
	}
	
	public JSONObject imggen(String mobile,String tno)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", img_tag));
		params.add(new BasicNameValuePair("mobile", mobile));
		params.add(new BasicNameValuePair("tino", tno));
		JSONObject json = jsonParser.getJSONFromUrl(imggenURL, params);
		return json;
		
	}
	public JSONObject deletall(String mobile)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", delete_tag));
		params.add(new BasicNameValuePair("mobile", mobile));
		@SuppressWarnings("unused")
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return null;
		
	}
	public JSONObject cost(String mobile)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", cost_tag));
		params.add(new BasicNameValuePair("mobile", mobile));
		
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	
	public JSONObject showtime(String mobile)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", time_tag));
		params.add(new BasicNameValuePair("mobile", mobile));
		
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	
	public JSONObject showdetl(String mobile)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", detail_tag));
		params.add(new BasicNameValuePair("mobile", mobile));
		
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	
	public JSONObject tupdate(String d_time,String cost,String mno)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", uptime_tag));
		params.add(new BasicNameValuePair("utime", d_time));
		params.add(new BasicNameValuePair("cost", cost));
		params.add(new BasicNameValuePair("mobile", mno));
		JSONObject json = jsonParser.getJSONFromUrl(chngtURL, params);
		return json;
	}
	public JSONObject edit(String mobileno)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", edit_tag));
		params.add(new BasicNameValuePair("mobile",mobileno));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
	}
	
	public JSONObject change_password(String mobile,String password,String nwpassword)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", chp_tag));
		params.add(new BasicNameValuePair("password",password));
		params.add(new BasicNameValuePair("mobile",mobile));
		params.add(new BasicNameValuePair("newpassword",nwpassword));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		return json;
		
	}
	public JSONObject update(String name, String email,String mobileno,String gender,String addrs,String birthd,String city,String state,String country)
	{
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", update_tag));
		params.add(new BasicNameValuePair("name", name));
		params.add(new BasicNameValuePair("email", email));
		params.add(new BasicNameValuePair("mobile",mobileno));
		params.add(new BasicNameValuePair("gen",gender));
		params.add(new BasicNameValuePair("addr", addrs));
		params.add(new BasicNameValuePair("dob", birthd));
		params.add(new BasicNameValuePair("cty", city));
		params.add(new BasicNameValuePair("stat",state));
		params.add(new BasicNameValuePair("cntry",country));
		
		
		// getting JSON Object
		JSONObject json = jsonParser.getJSONFromUrl(registerURL, params);
		// return json
		return json;
		
	}
	/**
	 * function make Login Request
	 * @param name
	 * @param email
	 * @param password
	 * */
	public JSONObject registerUser(String name, String email, String password,String mobileno,String gender,String addrs,String birthd,String city,String state,String country){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", register_tag));
		params.add(new BasicNameValuePair("name", name));
		params.add(new BasicNameValuePair("email", email));
		params.add(new BasicNameValuePair("password", password));
		params.add(new BasicNameValuePair("mobile",mobileno));
		params.add(new BasicNameValuePair("gen",gender));
		params.add(new BasicNameValuePair("addr", addrs));
		params.add(new BasicNameValuePair("dob", birthd));
		params.add(new BasicNameValuePair("cty", city));
		params.add(new BasicNameValuePair("stat",state));
		params.add(new BasicNameValuePair("cntry",country));
		
		
		// getting JSON Object
		JSONObject json = jsonParser.getJSONFromUrl(registerURL, params);
		// return json
		return json;
	}
	
	/**
	 * Function get Login status
	 * */
	public boolean isUserLoggedIn(Context context){
		DatabaseHandler db = new DatabaseHandler(context);
		int count = db.getRowCount();
		if(count > 0){
			// user logged in
			return true;
		}
		return false;
	}
	
	/**
	 * Function to logout user
	 * Reset Database
	 * */
	public boolean logoutUser(Context context){
		DatabaseHandler db = new DatabaseHandler(context);
		db.resetTables();
		return true;
	}

	
	
}
