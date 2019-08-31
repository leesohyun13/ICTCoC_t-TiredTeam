import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class DatabaseManager {

    //db 접속정보.
    public static String server = "106.10.43.85:3306"; // MySQL 서버 주소
    public static String database_name = "ai"; // MySQL DATABASE 이름
    public static String db_id = "cho"; //  MySQL 서버 아이디
    public static String db_password = "teamnova"; // MySQL 서버 비밀번호

    public DatabaseManager()
    {

        //db에 현재 사용자의 값을 저장!
        // JDBC를 사용하여 db에 연결을 시작한다!
        // 1.드라이버 로딩
        try {
            Class.forName("org.mariadb.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            System.err.println(" !! <JDBC 오류> Driver load 오류: " + e.getMessage());
            e.printStackTrace();
            //System.exit(0);
        }

    }


    Connection db_connect()
    {
        //mysql에 연결된  conn객체를 받아옴!
        Connection db_conn = null;
        //mysql db에 연결
        try {
            db_conn = DriverManager.getConnection(
                    //"jdbc:mysql://" + server + "/" + database_name + "?useSSL=false &autoReconnect=true", db_id, db_password);
            "jdbc:mariadb://" + server + "/" + database_name + "?autoReconnect=true", db_id, db_password);
            //System.out.println("db_conn 연결됨!");
        } catch(SQLException e) {
            System.out.println(e.toString());
        }
        return db_conn;
    }

    void db_disconnect(Connection db_conn)
    {
        //mysql db에 연결해제!
        try
        {
            if(db_conn != null)
            {
                db_conn.close();
                //System.out.println("db_conn 해제됨!");
            }
        }
        catch (SQLException e)
        {
            System.out.println(e.toString());
        }
    }


    //해당하는 사고정보를 불러옴.
    // select * from  accident_data where accident_many_fid = !;

    //for문으로 횡단보도 지점을 전부 훑으면서 거리 계산후,
    //100m, 200m에 속하는지 여부를 판별하여 개수를 기억.  각각의 컬럼명은 one, two.

    //update accident_data set one = '100m개수', two = '200m개수' where accident_many_fid = !;

    //그후, 다음 사고정보를 불러오고 반복!


    void update_clustering_result(int accident_many_fid, int clustering_result)
    {
        Connection db_conn = db_connect();

        PreparedStatement pstmt=null;

        String sql = "update accident_data set clustering_result = ? where accident_many_fid = ?"; //user_IDToken

        try {
            //prepare로 세팅,
            pstmt = db_conn.prepareStatement(sql);

            //일종의 bindParam
            pstmt.setInt(1, clustering_result);

            //일종의 bindParam
            pstmt.setInt(2, accident_many_fid);


            //쿼리 실행
            int updated_row_count = pstmt.executeUpdate();

            if(updated_row_count != 1)
            {
                throw new SQLException("변경된 row갯수가 1이 아님! updated_row_count = "+updated_row_count);
            }
        } catch (SQLException e) {
            System.out.println(e.toString());
        }
        finally
        {
            try
            {
                if(pstmt != null)
                    pstmt.close();
                db_disconnect(db_conn);
            }
            catch (SQLException e)
            {
                System.out.println(e.toString());
            }
        }
    }


    //사고지점 기준 반경 ~m 횡단보도 데이터
    void update_accident_data(int accident_many_fid, int crosswalk_100m_Count, int crosswalk_200m_Count, int market_201m_Count, int library_201m_Count, int footbridge_201m_Count, int subway_201m_Count)
    {
        Connection db_conn = db_connect();

        PreparedStatement pstmt=null;

        String sql = "update accident_data set across_100m = ?, across_200m = ?, market = ?, library = ?, bridge = ?, subway = ? where accident_many_fid = ?"; //user_IDToken

        try {
            //prepare로 세팅,
            pstmt = db_conn.prepareStatement(sql);

            //일종의 bindParam
            pstmt.setInt(1, crosswalk_100m_Count);

            //일종의 bindParam
            pstmt.setInt(2, crosswalk_200m_Count);

            //일종의 bindParam
            pstmt.setInt(3, market_201m_Count);

            //일종의 bindParam
            pstmt.setInt(4, library_201m_Count);

            //일종의 bindParam
            pstmt.setInt(5, footbridge_201m_Count);

            //일종의 bindParam
            pstmt.setInt(6, subway_201m_Count);

            //일종의 bindParam
            pstmt.setInt(7, accident_many_fid);


            //쿼리 실행
            int updated_row_count = pstmt.executeUpdate();

            if(updated_row_count != 1)
            {
                throw new SQLException("변경된 row갯수가 1이 아님! updated_row_count = "+updated_row_count);
            }
        } catch (SQLException e) {
            System.out.println(e.toString());
        }
        finally
        {
            try
            {
                if(pstmt != null)
                    pstmt.close();
                db_disconnect(db_conn);
            }
            catch (SQLException e)
            {
                System.out.println(e.toString());
            }
        }
    }
    
}
