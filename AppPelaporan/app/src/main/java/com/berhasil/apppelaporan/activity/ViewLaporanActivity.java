package com.berhasil.apppelaporan.activity;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.SearchView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.MenuItemCompat;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.adapter.AdapterPelaporan;
import com.berhasil.apppelaporan.api.BaseApiService;
import com.berhasil.apppelaporan.api.RestClient;
import com.berhasil.apppelaporan.model.ModelPelaporan;
import com.berhasil.apppelaporan.response.ResponsePelaporan;
import com.berhasil.apppelaporan.utils.Constant;
import com.berhasil.apppelaporan.utils.SharePrefManager;
import com.blogspot.atifsoftwares.animatoolib.Animatoo;

import java.util.ArrayList;
import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ViewLaporanActivity extends AppCompatActivity implements SearchView.OnQueryTextListener{
    @BindView(R.id.rvPelaporan)
    RecyclerView rvPelaporan;

    List<ModelPelaporan> modelPelaporanList;
    AdapterPelaporan adapterPelaporan;
    BaseApiService mApiService;
    Context mContext;
    ProgressDialog loading;
    SharePrefManager sharePrefManager;
    String tmp_ktp;

    @BindView(R.id.refresh)
    SwipeRefreshLayout swipeRefresh;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_laporan);
        getSupportActionBar().setTitle("Lihat Pelaporan");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        ButterKnife.bind(this);
        mApiService = RestClient.getApiService();
        mContext = this;
        sharePrefManager = new SharePrefManager(this);
        tmp_ktp = sharePrefManager.getSpNoKtp();

        getAllPelaporan();

        swipeRefresh.setColorSchemeResources(
                android.R.color.holo_red_light,
                android.R.color.holo_orange_light,
                android.R.color.holo_green_light,
                android.R.color.holo_blue_bright
        );
        swipeRefresh.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        refreshItem();
                    }
                    void refreshItem() {
                        getAllPelaporan();
                        onItemLoad();
                    }
                    void onItemLoad() {
                        swipeRefresh.setRefreshing(false);
                    }
                }, 5000);
            }
        });
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home :
                startActivity(new Intent(mContext, MainActivity.class)
                    .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP));
                break;
        }
        return super.onOptionsItemSelected(item);
    }

    private void getAllPelaporan() {
        loading = ProgressDialog.show(mContext, null, "Sedang mengambil data", true, false);

        final Activity that = this;
        rvPelaporan.setVisibility(View.GONE);
        modelPelaporanList = new ArrayList<>();
        adapterPelaporan = new AdapterPelaporan(this, modelPelaporanList);

        adapterPelaporan.setOnKategoriClickListener(new AdapterPelaporan.onKategoriClickListener() {
            @Override
            public void onKategoriClick(int PelaporanId, int index) {
                ModelPelaporan getPelaporan = modelPelaporanList.get(index);
                Intent in = new Intent(that, ViewDetailLaporanActivity.class);
                in.putExtra(Constant.IMG_DETAIL, getPelaporan.getFotoLap());
                in.putExtra(Constant.NMKATEGORI_DETAIL, getPelaporan.getKd_kat());
                in.putExtra(Constant.KETERANGANLAP_DETAIL, getPelaporan.getKetLap());
                in.putExtra(Constant.TGL_PELAPORAN_DETAIL, getPelaporan.getTgl_lap());
                in.putExtra(Constant.STATUS_DETAIL, getPelaporan.getStatus());
                in.putExtra(Constant.NOTELP_DETAIL, getPelaporan.getNoTlpLap());
                that.startActivity(in);
            }
        });

        rvPelaporan.setLayoutManager(new LinearLayoutManager(this));
        rvPelaporan.setAdapter(adapterPelaporan);

        Call<ResponsePelaporan> rest = mApiService.getAllPelaporan(tmp_ktp);
        rest.enqueue(new Callback<ResponsePelaporan>() {
            @Override
            public void onResponse(Call<ResponsePelaporan> call, Response<ResponsePelaporan> response) {
                if (response.body().getAllPelaporan() != null) {
                    rvPelaporan.setVisibility(View.VISIBLE);
                    loading.dismiss();
                    modelPelaporanList.clear();
                    modelPelaporanList.addAll(response.body().getAllPelaporan());
                    adapterPelaporan.notifyDataSetChanged();
                }
                else {
                    loading.dismiss();
                    Toast.makeText(mContext, "Anda Belum Mempunyai Data Pelaporan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponsePelaporan> call, Throwable t) {
                loading.dismiss();
                Toast.makeText(that, "Koneksi bermasalah", Toast.LENGTH_SHORT).show();
            }
        });
    }


    @Override
    public void onBackPressed() {
        super.onBackPressed();
        startActivity(new Intent(mContext, MainActivity.class)
            .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
        Animatoo.animateSlideRight(mContext);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.seacrh_menu, menu);
        final MenuItem item = menu.findItem(R.id.action_search);
        final SearchView searchView = (SearchView) MenuItemCompat.getActionView(item);
        searchView.setQueryHint("Cari Laporan");
        searchView.setIconified(false);
        searchView.setOnQueryTextListener(this);
        return true;
    }

    @Override
    public boolean onQueryTextSubmit(String query) {
        return false;
    }

    @Override
    public boolean onQueryTextChange(String newText) {
        final Activity that = this;
        rvPelaporan.setVisibility(View.GONE);
        modelPelaporanList = new ArrayList<>();
        adapterPelaporan = new AdapterPelaporan(this, modelPelaporanList);

        adapterPelaporan.setOnKategoriClickListener(new AdapterPelaporan.onKategoriClickListener() {
            @Override
            public void onKategoriClick(int PelaporanId, int index) {
                ModelPelaporan getPelaporan = modelPelaporanList.get(index);
                Intent in = new Intent(that, ViewDetailLaporanActivity.class);
                in.putExtra(Constant.IMG_DETAIL, getPelaporan.getFotoLap());
                in.putExtra(Constant.NMKATEGORI_DETAIL, getPelaporan.getKd_kat());
                in.putExtra(Constant.KETERANGANLAP_DETAIL, getPelaporan.getKetLap());
                in.putExtra(Constant.TGL_PELAPORAN_DETAIL, getPelaporan.getTgl_lap());
                in.putExtra(Constant.STATUS_DETAIL, getPelaporan.getStatus());
                in.putExtra(Constant.NOTELP_DETAIL, getPelaporan.getNoTlpLap());
                that.startActivity(in);
            }
        });

        rvPelaporan.setLayoutManager(new LinearLayoutManager(this));
        rvPelaporan.setAdapter(adapterPelaporan);

        Call<ResponsePelaporan> rest = mApiService.search(tmp_ktp, newText);
        rest.enqueue(new Callback<ResponsePelaporan>() {
            @Override
            public void onResponse(Call<ResponsePelaporan> call, Response<ResponsePelaporan> response) {
                if (response.body().getAllPelaporan() != null) {
                    rvPelaporan.setVisibility(View.VISIBLE);
                    modelPelaporanList.clear();
                    modelPelaporanList.addAll(response.body().getAllPelaporan());
                    adapterPelaporan.notifyDataSetChanged();
                }
                else {
                    loading.dismiss();
                    Toast.makeText(mContext, "Anda Belum Mempunyai Data Pelaporan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponsePelaporan> call, Throwable t) {
                Toast.makeText(that, "Koneksi bermasalah", Toast.LENGTH_SHORT).show();
            }
        });
        return true;
    }


}
