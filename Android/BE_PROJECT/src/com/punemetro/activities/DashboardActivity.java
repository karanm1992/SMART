 
package com.punemetro.activities;

import com.example.androidhive.R;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class DashboardActivity extends Activity {
	
	Button img_btn;
    @Override
    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.dashboard);
        	img_btn = (Button) findViewById(R.id.btnLogout);
        	
        	img_btn.setOnClickListener(new View.OnClickListener() 
        	{
    			
    			public void onClick(View arg0){
    				// TODO Auto-generated method stub
    				Intent login = new Intent(getApplicationContext(), LoginActivity.class);
    	        	login.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
    	        	startActivity(login);
    	        	// Closing dashboard screen
    	        	finish();
    			}
    		});
       
    }
    
}