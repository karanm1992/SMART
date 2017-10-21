package com.punemetro.activities;

import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class Info extends Activity
{
	TextView source,destn,time,route,cost;
	public String mno,src,dest,d_time,clr,cst,ntime;
	Button pay;
	public void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.info);
		Bundle extras = getIntent().getExtras();
		
		if (extras != null)
		{
		    src = extras.getString("src");
		    dest= extras.getString("dest");
		    mno = extras.getString("user");
		    d_time = extras.getString("time");
		}
		
		source = (TextView) findViewById (R.id.textView2);
		destn = (TextView) findViewById (R.id.textView4);
		time = (TextView) findViewById (R.id.textView6);
		route = (TextView) findViewById (R.id.textView8);
		cost = (TextView) findViewById (R.id.textView11);
		
		CharSequence svalue = null;
		svalue = src.subSequence(0,src.length());
		source.setText(svalue);
		
		CharSequence dvalue = null;
		dvalue = dest.subSequence(0,dest.length());
		destn.setText(dvalue);
		
		CharSequence tvalue = null;
		tvalue = d_time.subSequence(0,d_time.length());
		time.setText(tvalue);
		
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.showdetl(mno);
		
		try {
			JSONObject json_user = json.getJSONObject("user");
			clr = json_user.getString("route");
			cst = json_user.getString("cost");
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		CharSequence clrvalue = null;
		clrvalue = clr.subSequence(0,clr.length());
		route.setText(clrvalue);
		
		CharSequence cstvalue = null;
		cstvalue = cst.subSequence(0,cst.length());
		cost.setText(cstvalue);
		
			
	}
	public void payment(View clickedButton)
	{
		UserFunctions userFunction1 = new UserFunctions();
		@SuppressWarnings("unused")
		JSONObject json1 = userFunction1.tupdate(d_time,cst,mno);
		Intent activityIntent = new Intent(this,Payment.class);
		activityIntent .putExtra("user", mno);
		startActivity(activityIntent);
	}
}
