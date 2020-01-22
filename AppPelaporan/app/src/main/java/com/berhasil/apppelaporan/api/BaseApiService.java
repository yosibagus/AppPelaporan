package com.berhasil.apppelaporan.api;

import com.berhasil.apppelaporan.response.ResponseKategori;
import com.berhasil.apppelaporan.response.ResponsePelaporan;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface BaseApiService {

    @GET("get_all_laporan.php")
    Call<ResponsePelaporan> getAllPelaporan(@Query("ktp_lap") String ktpLap);

    @GET("get_all_kategori.php")
    Call<ResponseKategori> getAllKategori();

    @FormUrlEncoded
    @POST("addPelaporanById.php")
    Call<ResponseBody> addPelaporan(
            @Field("kd_kat") String kdKat,
            @Field("foto_lap") String fotoLap,
            @Field("lokasi_lap") String lokasi,
            @Field("ket_lap") String ket_lap,
            @Field("ktp_lap") String ktpLap
    );

    @FormUrlEncoded
    @POST("loginUser.php")
    Call<ResponseBody> loginRequest(@Field("noktp") String noKtp, @Field("password") String password);

    @FormUrlEncoded
    @POST("addRegestrasiUser.php")
    Call<ResponseBody> addRegestrasi(
            @Field("noktp") String noKtp,
            @Field("password") String password,
            @Field("scan_ktp") String scanKtp,
            @Field("nama") String nama,
            @Field("notelp") String noTelp
    );

    @FormUrlEncoded
    @POST("search.php")
    Call<ResponsePelaporan> search(@Field("ktp") String ktp, @Field("search") String searching);

}
