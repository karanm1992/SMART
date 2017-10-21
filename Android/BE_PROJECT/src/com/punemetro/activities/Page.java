package com.punemetro.activities;


import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class Page extends Activity
{
	String value;
	public String mno,cnt,p_val;
	final Context context = this;
	Button route,edit,mytic,logout;
	
	protected void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.page);
		Bundle extras = getIntent().getExtras();
		if (extras != null)
		{
		    value = extras.getString("user");
		}
		
		route = (Button) findViewById(R.id.button1);
		edit = (Button) findViewById(R.id.button2);
		mytic = (Button) findViewById(R.id.button3);
		logout = (Button) findViewById(R.id.button4);
		
		route.setEnabled(true);
		edit.setEnabled(true);
		mytic.setEnabled(true);
		logout.setEnabled(true);
	}
	
	public void logout(View clickedButton)
	{
		logout.setEnabled(false);
		Intent activityIntent = new Intent(this,DashboardActivity.class);
		startActivity(activityIntent);
		System.exit(0);
		logout.setEnabled(true);
	}
	public void schdl(View clickedButton)
	{
		route.setEnabled(false);
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.getcount(value);
		
		try 
		{
			JSONObject json_user = json.getJSONObject("user");
			cnt = json_user.getString("ctt");
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		int c = Integer.parseInt(cnt);
		if( c > 0)
		{
			AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
					context);
			alertDialogBuilder.setTitle("Message");
			alertDialogBuilder.setCancelable(true);
			alertDialogBuilder
				.setMessage("YOU HAVE ACTIVE TICKETS" +
						" GO TO MY TICKETS")
				.setNeutralButton("OK", new DialogInterface.OnClickListener() {
	            	public void onClick(DialogInterface dialog, int id)
	            	{
	            		route.setEnabled(true);
	            		dialog.cancel();
	            	}
				});
			
		// 	create alert dialog
			AlertDialog alertDialog = alertDialogBuilder.create();
			
		// 	show it
			alertDialog.show();
			
		}
		else
		{	route.setEnabled(true);
			Intent activityIntent = new Intent(this,Page1.class);
			activityIntent.putExtra("user", value);
			startActivity(activityIntent);
		}
		
	}
	public void schd2(View clickedButton)
	{
		edit.setEnabled(false);
		Intent activityIntent = new Intent(this,Editprof.class);
		activityIntent.putExtra("user",value);
		startActivity(activityIntent);
		edit.setEnabled(true);
	}
	public void schd3(View clickedButton)
	{
		mytic.setEnabled(false);
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.getcount(value);
		
		try {
			JSONObject json_user = json.getJSONObject("user");
			
		     cnt = json_user.getString("ctt");
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		UserFunctions userFunction1 = new UserFunctions();
		JSONObject json1 = userFunction1.chck_paid(value);
		try {
			JSONObject json_user1 = json1.getJSONObject("user");
			
		     p_val = json_user1.getString("val");
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		int c = Integer.parseInt(cnt);
		if(c > 0 && p_val.equals("paid"))
		{
			
			Intent activityIntent = new Intent(this,Sel_ticket.class);
			activityIntent.putExtra("user", value);
			activityIntent.putExtra("no", cnt);
			startActivity(activityIntent);
			mytic.setEnabled(true);
		}
		else
		{
			AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
				context);
			alertDialogBuilder.setTitle("Message");
			alertDialogBuilder.setCancelable(true);
			alertDialogBuilder
			.setMessage("NO ACTIVE TICKETS")
			.setNeutralButton("OK", new DialogInterface.OnClickListener() {
            	public void onClick(DialogInterface dialog, int id)
            	{
            		mytic.setEnabled(true);
            		dialog.cancel();
            	}
			});
		
	// 	create alert dialog
		AlertDialog alertDialog = alertDialogBuilder.create();
		
	// 	show it
		alertDialog.show();
			
		}
	}
}
