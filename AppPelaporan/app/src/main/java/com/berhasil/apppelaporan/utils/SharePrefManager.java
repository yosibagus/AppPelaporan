package com.berhasil.apppelaporan.utils;

import android.content.Context;
import android.content.SharedPreferences;

public class SharePrefManager {

    public static final String SP_USER_APP = "spUserApp";
    public static final String SP_NO_KTP = "spNoKtp";
    public static final String SP_NAMA_USER = "spNamaUser";
    public static final String SP_STATUS_AKUN = "spStatusAkun";
    public static final String SP_NOTELP_USER = "spNoTelpUser";

    public static final String SP_SUDAH_LOGIN = "spSudahLogin";

    SharedPreferences sp;
    SharedPreferences.Editor spEditor;

    public SharePrefManager(Context context) {
        sp = context.getSharedPreferences(SP_USER_APP, context.MODE_PRIVATE);
        spEditor = sp.edit();
    }

    public void saveSPString(String kySP, String value) {
        spEditor.putString(kySP, value);
        spEditor.commit();
    }

    public void saveSPInt(String keySP, int value) {
        spEditor.putInt(keySP, value);
        spEditor.commit();
    }

    public void saveSPBoolean(String keySP, boolean value) {
        spEditor.putBoolean(keySP, value);
        spEditor.commit();
    }

    public String getSpUserApp() {
        return sp.getString(SP_USER_APP, "");
    }

    public String getSpNoKtp() {
        return sp.getString(SP_NO_KTP, "");
    }

    public String getSpNamaUser() {
        return sp.getString(SP_NAMA_USER, "");
    }

    public String getSpNotelpUser() {
        return sp.getString(SP_NOTELP_USER, "");
    }

    public String getSpStatusAkun() {
        return sp.getString(SP_STATUS_AKUN, "");
    }

    public Boolean getSpSudahLogin() {
        return sp.getBoolean(SP_SUDAH_LOGIN, false) ;
    }
}
