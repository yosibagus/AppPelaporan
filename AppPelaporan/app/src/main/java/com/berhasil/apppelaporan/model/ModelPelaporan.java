package com.berhasil.apppelaporan.model;

import com.google.gson.annotations.SerializedName;

public class ModelPelaporan {
    @SerializedName("kd_lap") private int kd_lap;
    @SerializedName("nm_kat") private String kd_kat;
    @SerializedName("foto_lap") private String fotoLap;
    @SerializedName("lokasi_lap") private String lokasi;
    @SerializedName("ket_lap") private String ketLap;
    @SerializedName("ktp_lap") private String ktpLap;
    @SerializedName("nm_lap") private String nmLap;
    @SerializedName("notelp_lap") private String noTlpLap;
    @SerializedName("tgl_lap") private String tgl_lap;
    @SerializedName("status_lap") private String status;
    @SerializedName("error") private String errorMSG;

    public String getErrorMSG() {
        return errorMSG;
    }

    public int getKd_lap() {
        return kd_lap;
    }

    public String getKd_kat() {
        return kd_kat;
    }

    public String getFotoLap() {
        return fotoLap;
    }

    public String getLokasi() {
        return lokasi;
    }

    public String getKetLap() {
        return ketLap;
    }

    public String getKtpLap() {
        return ktpLap;
    }

    public String getNmLap() {
        return nmLap;
    }

    public String getNoTlpLap() {
        return noTlpLap;
    }

    public String getTgl_lap() {
        return tgl_lap;
    }

    public String getStatus() {
        return status;
    }
}
