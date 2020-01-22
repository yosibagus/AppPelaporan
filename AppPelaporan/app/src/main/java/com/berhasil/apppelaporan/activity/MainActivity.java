package com.berhasil.apppelaporan.activity;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.utils.SharePrefManager;
import com.blogspot.atifsoftwares.animatoolib.Animatoo;

import butterknife.BindView;
import butterknife.ButterKnife;

public class MainActivity extends AppCompatActivity {

    String tmp_sessionUser;
    @BindView(R.id.btn_input)
    LinearLayout btnToKategori;
    @BindView(R.id.btn_list)
    LinearLayout btnList;
    @BindView(R.id.btnLogout)
    LinearLayout btnLogout;
    @BindView(R.id.sessionUserName)
    TextView nameUser;

    SharePrefManager sharePrefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().hide();
        ButterKnife.bind(this);
        sharePrefManager = new SharePrefManager(this);

        tmp_sessionUser = sharePrefManager.getSpNamaUser();
        nameUser.setText(tmp_sessionUser);

        btnToKategori.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, ViewKategoriActivity.class));
            }
        });

        btnList.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, ViewLaporanActivity.class));
            }
        });

        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                logout();
            }
        });

    }

    private void logout() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage("Yakin Ingin Keluar ?");
        builder.setTitle("Logout");
        builder.setPositiveButton("Ya", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                Toast.makeText(MainActivity.this, "Anda Keluar", Toast.LENGTH_SHORT).show();
                sharePrefManager.saveSPBoolean(sharePrefManager.SP_SUDAH_LOGIN, false);
                startActivity(new Intent(MainActivity.this, LoginActivity.class)
                    .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                Animatoo.animateFade(MainActivity.this);
                finish();
            }
        });
        builder.setNegativeButton("Tidak", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.cancel();
            }
        });
        AlertDialog alert = builder.create();
        alert.show();
    }
}
