package com.berhasil.apppelaporan.activity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.api.BaseApiService;
import com.berhasil.apppelaporan.api.RestClient;
import com.berhasil.apppelaporan.utils.SharePrefManager;
import com.blogspot.atifsoftwares.animatoolib.Animatoo;
import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

import butterknife.BindView;
import butterknife.ButterKnife;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {
    @BindView(R.id.etKTP)
    TextInputEditText etKTP;
    @BindView(R.id.etPassword)
    TextInputEditText etPassword;
    @BindView(R.id.btnLogin)
    Button btnLogin;
    @BindView(R.id.btnRegestrasi)
    Button btnRegestrasi;

    ProgressDialog loading;
    BaseApiService mApiService;
    Context mContext;
    SharePrefManager sharePrefManager;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        getSupportActionBar().hide();
        ButterKnife.bind(this);
        mContext = this;
        mApiService = RestClient.getApiService();
        sharePrefManager = new SharePrefManager(this);

        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loading = ProgressDialog.show(mContext, null, "Proses ..", true, false);
                requestLogin();
            }
        });

        btnRegestrasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(LoginActivity.this, InputRegestrasiActivity.class));
                Animatoo.animateSlideUp(mContext);
            }
        });
    }

    @Override
    protected void onPostResume() {
        super.onPostResume();
        etKTP.clearFocus();
        etPassword.clearFocus();
    }

    private void requestLogin() {
        mApiService.loginRequest(etKTP.getText().toString(), etPassword.getText().toString())
                .enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        if (response.isSuccessful()) {
                            try {
                                JSONObject jsonResult = new JSONObject(response.body().string());
                                if (jsonResult.getString("error").equals("false")) {
                                    if (jsonResult.getString("status_akun").equals("Active")) {
                                        String namaUser = jsonResult.getString("nm_lap");
                                        String ktpLap = jsonResult.getString("ktp_lap");
                                        String noTelp = jsonResult.getString("nomertelp");
                                        sharePrefManager.saveSPString(sharePrefManager.SP_NAMA_USER, namaUser);
                                        sharePrefManager.saveSPString(sharePrefManager.SP_NO_KTP, ktpLap);
                                        sharePrefManager.saveSPString(sharePrefManager.SP_NOTELP_USER, noTelp);
                                        sharePrefManager.saveSPBoolean(sharePrefManager.SP_SUDAH_LOGIN, true);
                                        new Handler().postDelayed(new Runnable() {
                                            @Override
                                            public void run() {
                                                loading.dismiss();
                                                Toast.makeText(mContext, "Anda Berhasil Login", Toast.LENGTH_SHORT).show();
                                                startActivity(new Intent(mContext, MainActivity.class)
                                                    .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                                                Animatoo.animateFade(mContext);
                                                finish();
                                            }
                                        }, 1000);
                                    } else {
                                        loading.dismiss();
                                        Toast.makeText(mContext, "Akun Belum Aktif, Tunggu verifikasi dari Admin", Toast.LENGTH_SHORT).show();
                                    }
                                } else {
                                    loading.dismiss();
                                    Toast.makeText(mContext, "Username/Password Salah", Toast.LENGTH_SHORT).show();
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            } catch (IOException e) {
                                e.printStackTrace();
                            }
                        } else {
                            loading.dismiss();
                            Toast.makeText(mContext, "gagal melakukan login", Toast.LENGTH_SHORT).show();
                        }
                    }

                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) {
                        loading.dismiss();
                        Toast.makeText(mContext, "koneksi bermasalah", Toast.LENGTH_SHORT).show();
                    }
                });
    }
}
