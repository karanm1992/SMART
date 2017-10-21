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
import android.widget.TextView;

public class Prepaid extends Activity {
	
	public String mno,tcost,count;
	public TextView mobile,ct;
	public Button qrcd;
	final Context context = this;
	
	public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.prepaid);
       Bundle extras = getIntent().getExtras();
		if (extras != null)
		{
		    mno = extras.getString("user");
		    count = extras.getString("count");   
		}
		
		mobile = (TextView) findViewById(R.id.textView2);
		ct = (TextView) findViewById(R.id.textView4);
		
		CharSequence nvalue = null;
		nvalue = mno.subSequence(0,mno.length());
		mobile.setText(nvalue);
		
		qrcd = (Button)findViewById(R.id.button1);
		
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.cost(mno);
		
		try {
			
			JSONObject json_user = json.getJSONObject("user");
			tcost = json_user.getString("cost");
			CharSequence hvalue = null;
			hvalue = tcost.subSequence(0,tcost.length());
			ct.setText(hvalue);
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

}
	public void go(View clickedButton)
	{	
		AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
				context);
		alertDialogBuilder.setTitle("Success!!");
		alertDialogBuilder.setCancelable(true);
		alertDialogBuilder
			.setMessage("Your Payment has been made")
			.setNeutralButton("OK", new DialogInterface.OnClickListener() {
            	public void onClick(DialogInterface dialog, int id)
            	{
            		UserFunctions userFunction1 = new UserFunctions();
					@SuppressWarnings("unused")
					JSONObject json1 = userFunction1.makepayment(mno);
					
					Intent activityIntent = new Intent(getApplicationContext(),Sel_ticket.class);
					activityIntent.putExtra("user",mno);
					activityIntent.putExtra("no", count);
					startActivity(activityIntent);
					
            	}
			});
		
	// 	create alert dialog
		AlertDialog alertDialog = alertDialogBuilder.create();
		
	// 	show it
		alertDialog.show();
		
	}
}