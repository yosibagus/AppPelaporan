package com.berhasil.apppelaporan.activity;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.adapter.AdapterKategori;
import com.berhasil.apppelaporan.api.BaseApiService;
import com.berhasil.apppelaporan.api.RestClient;
import com.berhasil.apppelaporan.model.ModelKategori;
import com.berhasil.apppelaporan.model.ModelPelaporan;
import com.berhasil.apppelaporan.response.ResponseKategori;
import com.berhasil.apppelaporan.utils.Constant;
import com.berhasil.apppelaporan.utils.SharePrefManager;

import java.util.ArrayList;
import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ViewKategoriActivity extends AppCompatActivity {
    @BindView(R.id.rvKategori)
    RecyclerView rvKategori;

    List<ModelKategori> items;
    AdapterKategori adapter;
    BaseApiService mApiService;
    Context mContext;
    ProgressDialog loading;
    SharePrefManager sharePrefManager;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_kategori);
        sharePrefManager = new SharePrefManager(this);
        getSupportActionBar().setTitle("Kategori Pelaporan");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        ButterKnife.bind(this);
        mApiService = RestClient.getApiService();
        mContext = this;

        getAllKategori();
    }

    private void getAllKategori() {
        loading = ProgressDialog.show(mContext, null, "Sedang mengambil data", true, false);

        final Activity that = this;
        rvKategori.setVisibility(View.GONE);
        items = new ArrayList<>();
        adapter = new AdapterKategori(this, items);

        adapter.setOnKategoriClickListener(new AdapterKategori.onKategoriClickListener() {
            @Override
            public void onKategoriClick(int KategoriId, int index) {
                ModelKategori mKategori = items.get(index);
                //mengirim data foreignkey ke activity input pelaporan
                Intent in = new Intent(that, InputLaporanActivity.class);
                in.putExtra(Constant.KEY_ID_KATEGORI, String.valueOf(mKategori.getKd_kat()));
                in.putExtra(Constant.KEY_NAMA_KATEGORI, mKategori.getNamaKategori());
                that.startActivity(in);
            }
        });

        rvKategori.setLayoutManager(new GridLayoutManager(this, 2));
        rvKategori.setAdapter(adapter);

        Call<ResponseKategori> rest = mApiService.getAllKategori();
        rest.enqueue(new Callback<ResponseKategori>() {
            @Override
            public void onResponse(Call<ResponseKategori> call, Response<ResponseKategori> response) {
                if (response.isSuccessful()) {
                    loading.dismiss();
                    rvKategori.setVisibility(View.VISIBLE);
                    items.clear();
                    items.addAll(response.body().getAllKategori());
                    adapter.notifyDataSetChanged();
                }
                else {
                    loading.dismiss();
                    Toast.makeText(mContext, "gagal memuat data", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseKategori> call, Throwable t) {
                loading.dismiss();
                Toast.makeText(mContext, "koneksi bermasalah", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home :
                finish();
                break;
        }
        return super.onOptionsItemSelected(item);
    }
}
