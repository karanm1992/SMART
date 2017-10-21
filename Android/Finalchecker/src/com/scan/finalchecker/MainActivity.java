package com.scan.finalchecker;


import java.io.InputStream;
import org.json.JSONException;
import org.json.JSONObject;

import android.os.Bundle;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;
import com.scan.finalchecker.library.UserFunctions;


public class MainActivity extends Activity implements OnClickListener {

	private Button scanBtn;
	public String cnt;
	public String scanContent = "";
	InputStream is = null;
	StringBuilder sb = null;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		scanBtn = (Button)findViewById(R.id.scan_button);
		scanBtn.setOnClickListener(this);
	}
	
	public void onClick(View v){
		//respond to clicks
		if(v.getId()==R.id.scan_button){
			IntentIntegrator scanIntegrator = new IntentIntegrator(this);
			scanIntegrator.initiateScan();
			//scan
			}
		}
	
	public void onActivityResult(int requestCode, int resultCode, Intent intent) {	
		//retrieve scan result
		IntentResult scanningResult = IntentIntegrator.parseActivityResult(requestCode, resultCode, intent);
		if (scanningResult != null) {
			//we have a result
			scanContent = scanningResult.getContents();
			@SuppressWarnings("unused")
			String scanFormat = scanningResult.getFormatName();
			
			go(scanContent);
		    
		}
		else
		{
		    Toast toast = Toast.makeText(getApplicationContext(), 
		        "No scan data received!", Toast.LENGTH_SHORT);
		    toast.show();
		}
		}

	private void go(String scanContent2) {
		
		    UserFunctions userfunction = new UserFunctions();
			JSONObject json = userfunction.check(scanContent2);
			
		try 
			{
				JSONObject json_user = json.getJSONObject("user");
				cnt = json_user.getString("ctt");
				
			} catch (JSONException e) {
				e.printStackTrace();
			}
			int c = Integer.parseInt(cnt);
		if(c == 1)
		{
			AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
					this);
			alertDialogBuilder.setTitle("Message");
			alertDialogBuilder.setCancelable(true);
			alertDialogBuilder
				.setMessage("VALID TICKET")
				.setNeutralButton("OK", new DialogInterface.OnClickListener() {
	            	public void onClick(DialogInterface dialog, int id)
	            	{
	   	            		dialog.cancel();
	            	}
				});
			
		// 	create alert dialog
			AlertDialog alertDialog = alertDialogBuilder.create();
			
		// 	show it
			alertDialog.show();
		}
		else
		{
			AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
					this);
			alertDialogBuilder.setTitle("Message");
			alertDialogBuilder.setCancelable(true);
			alertDialogBuilder
				.setMessage("INVALID TICKET")
				.setNeutralButton("OK", new DialogInterface.OnClickListener() {
	            	public void onClick(DialogInterface dialog, int id)
	            	{
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
