import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.LinkedList;

public class Main {


    public static void main(String[] args) {

        DatabaseManager db = new DatabaseManager();

        try {
            //파일 데이터 입력받음.
            LinkedList<String> accident_data = new LinkedList<>();


            ArrayList<String> crosswalk_data = new ArrayList<>();
            ArrayList<String> market_data = new ArrayList<>();
            ArrayList<String> library_data = new ArrayList<>();
            ArrayList<String> footbridge_data = new ArrayList<>();
            ArrayList<String> subway_data = new ArrayList<>();

            //위의 모든 사항이 추가된 파일.
            //횡단보도 수 +,갯수
            //시장 수 +,갯수
            //도서관 수 +,갯수
            //육교 수 +,갯수
            //지하철역 수 +,갯수
            ArrayList<String> updated_accident_data = new ArrayList<>();




            //입력 스트림 생성
            FileReader filereader = new FileReader("final_cluster_data.txt");
            //입력 버퍼 생성
            BufferedReader bufReader = new BufferedReader(filereader);

            //문자열 1줄단위로 읽기.
            String line;
            while ((line = bufReader.readLine()) != null) {

                accident_data.addLast(line.trim());

            }
            //.readLine()은 끝에 개행문자를 읽지 않는다.
            bufReader.close();
            filereader.close();
            System.out.println("accident_data = " + accident_data.size() + " 항목.");



            //입력 스트림 생성
            FileReader filereader2 = new FileReader("crosswalk_seoul.txt");
            //입력 버퍼 생성
            BufferedReader bufReader2 = new BufferedReader(filereader2);

            //문자열 1줄단위로 읽기.
            String line2;
            while ((line2 = bufReader2.readLine()) != null) {

                crosswalk_data.add(line2.trim());

            }
            //.readLine()은 끝에 개행문자를 읽지 않는다.
            bufReader2.close();
            filereader2.close();
            System.out.println("crosswalk_data = " + crosswalk_data.size() + " 항목.");



            //입력 스트림 생성
            FileReader filereader3 = new FileReader("market_seoul.txt");
            //입력 버퍼 생성
            BufferedReader bufReader3 = new BufferedReader(filereader3);

            //문자열 1줄단위로 읽기.
            String line3;
            while ((line3 = bufReader3.readLine()) != null) {

                market_data.add(line3.trim());

            }
            //.readLine()은 끝에 개행문자를 읽지 않는다.
            bufReader3.close();
            filereader3.close();
            System.out.println("market_data = " + market_data.size() + " 항목.");



            //입력 스트림 생성
            FileReader filereader4 = new FileReader("library_seoul.txt");
            //입력 버퍼 생성
            BufferedReader bufReader4 = new BufferedReader(filereader4);

            //문자열 1줄단위로 읽기.
            String line4;
            while ((line4 = bufReader4.readLine()) != null) {

                library_data.add(line4.trim());

            }
            //.readLine()은 끝에 개행문자를 읽지 않는다.
            bufReader4.close();
            filereader4.close();
            System.out.println("library_data = " + library_data.size() + " 항목.");




            //입력 스트림 생성
            FileReader filereader5 = new FileReader("footbridge_seoul.txt");
            //입력 버퍼 생성
            BufferedReader bufReader5 = new BufferedReader(filereader5);

            //문자열 1줄단위로 읽기.
            String line5;
            while ((line5 = bufReader5.readLine()) != null) {

                footbridge_data.add(line5.trim());
            }
            //.readLine()은 끝에 개행문자를 읽지 않는다.
            bufReader5.close();
            filereader5.close();
            System.out.println("footbridge_data = " + footbridge_data.size() + " 항목.");



            //입력 스트림 생성
            FileReader filereader6 = new FileReader("subway_seoul.txt");
            //입력 버퍼 생성
            BufferedReader bufReader6 = new BufferedReader(filereader6);

            //문자열 1줄단위로 읽기.
            String line6;
            while ((line6 = bufReader6.readLine()) != null) {

                subway_data.add(line6.trim());
            }
            //.readLine()은 끝에 개행문자를 읽지 않는다.
            bufReader6.close();
            filereader6.close();
            System.out.println("subway_data = " + subway_data.size() + " 항목.");








            //해당하는 사고정보를 불러옴.
            // select * from  accident_data where accident_many_fid = !;

            //for문으로 횡단보도 지점을 전부 훑으면서 거리 계산후,
            //100m, 200m에 속하는지 여부를 판별하여 개수를 기억.  각각의 컬럼명은 one, two.

            //update accident_data set one = '100m개수', two = '200m개수' where accident_many_fid = !;

            //그후, 다음 사고정보를 불러오고 반복!






            System.out.println(accident_data.size() + "항목 작업 시작.");

            StringBuilder sbLOG = new StringBuilder();

            //위도 latitude 37, 경도 longitude 127
            int size = accident_data.size();
            for (int i = 0; i < size; i++)
            {
                String fileline = accident_data.poll();

                String[] splitData = fileline.split(",");

                int accident_many_fid = Integer.parseInt(splitData[0]);
                double latitude = Double.parseDouble(splitData[splitData.length - 1]);
                double longitude = Double.parseDouble(splitData[splitData.length - 2]);

                //System.out.println("accident_many_fid="+accident_many_fid +"  "+latitude+ "/"+longitude);

                //사고지점 반경 100~200m 횡단보도 수.
                int crosswalk_100m_Count = 0;
                int crosswalk_200m_Count = 0;

                //사고지점 반경 201m 시장 수.
                int market_201m_Count = 0;

                //사고지점 반경 201m 도서관 수.
                int library_201m_Count = 0;

                //사고지점 반경 201m 육교 수.
                int footbridge_201m_Count = 0;

                //사고지점 반경 201m 지하철역 수.
                int subway_201m_Count = 0;



                // 사고지점 - 횡단보도간 거리 계산 부분.
                for (int j = 0; j < crosswalk_data.size(); j++)
                {
                    String fileline2 = crosswalk_data.get(j);

                    String[] splitData2 = fileline2.split(",");
                    double longitude2 = Double.parseDouble(splitData2[0]); //127
                    double latitude2 = Double.parseDouble(splitData2[1]); //37

                    //System.out.println("object_id="+object_id +"  "+latitude2+ "/"+longitude2);
                    double distance = getDistance(latitude, longitude, latitude2, longitude2);
                    //System.out.println("distance="+distance);

                    if (distance <= 100.0) {
                        //System.out.println("distance="+distance);
                        crosswalk_100m_Count++;
                    }
                    if (distance <= 200.0) {
                        //System.out.println("distance="+distance);
                        crosswalk_200m_Count++;
                    }
                }

                //db.update_accident_data(accident_many_fid, crosswalk_100m_Count, crosswalk_200m_Count);

                fileline = fileline + ","+crosswalk_100m_Count+","+crosswalk_200m_Count;

                //경도 longitude 127,  위도 latitude 37
                System.out.println(i+" accident_many_fid=" + accident_many_fid + " crosswalk_100m_Count=" + crosswalk_100m_Count + "/ crosswalk_200m_Count=" + crosswalk_200m_Count);
                sbLOG.append(i+" accident_many_fid=" + accident_many_fid + " crosswalk_100m_Count=" + crosswalk_100m_Count + "/ crosswalk_200m_Count=" + crosswalk_200m_Count);
                sbLOG.append("\n\n===========================================\n\n ");





                // 사고지점 - 시장, 마트간 거리 계산 부분.
                for (int j = 0; j <market_data.size(); j++)
                {
                    String fileline2 = market_data.get(j);

                    String[] splitData2 = fileline2.split(",");
                    double longitude2 = Double.parseDouble(splitData2[0]); //127
                    double latitude2 = Double.parseDouble(splitData2[1]); //37

                    double distance = getDistance(latitude, longitude, latitude2, longitude2);
                    //System.out.println("distance="+distance);

                    if (distance <= 201.0) {
                        //System.out.println("distance="+distance);
                        //testDistance = "distance="+distance+"\n";
                        market_201m_Count++;
                    }
                }

                //db.update_accident_data(accident_many_fid, crosswalk_100m_Count, crosswalk_200m_Count);

                fileline = fileline + ","+market_201m_Count;

                String log = i+" accident_many_fid=" + accident_many_fid + " market_201m_Count=" + market_201m_Count;
                //경도 longitude 127,  위도 latitude 37
                System.out.println(log);
                sbLOG.append(log);
                sbLOG.append("\n\n===========================================\n\n ");




                // 사고지점 - 도서관간 거리 계산 부분.
                for (int j = 0; j <library_data.size(); j++)
                {
                    String fileline2 = library_data.get(j);

                    String[] splitData2 = fileline2.split(",");

                    double longitude2 = Double.parseDouble(splitData2[0]); //127
                    double latitude2 = Double.parseDouble(splitData2[1]); //37

                    double distance = getDistance(latitude, longitude, latitude2, longitude2);
                    //System.out.println("distance="+distance);

                    if (distance <= 201.0) {
                        //System.out.println("distance="+distance);
                        //testDistance = "distance="+distance+"\n";
                        library_201m_Count++;
                    }
                }

                //db.update_accident_data(accident_many_fid, crosswalk_100m_Count, crosswalk_200m_Count);

                fileline = fileline + ","+library_201m_Count;

                String log2 = i+" accident_many_fid=" + accident_many_fid + " library_201m_Count=" + library_201m_Count;
                //경도 longitude 127,  위도 latitude 37
                System.out.println(log2);
                sbLOG.append(log2);
                sbLOG.append("\n\n===========================================\n\n ");




                // 사고지점 - 육교간 거리 계산 부분.
                for (int j = 0; j <footbridge_data.size(); j++)
                {
                    String fileline2 = footbridge_data.get(j);

                    String[] splitData2 = fileline2.split(",");
                    double longitude2 = Double.parseDouble(splitData2[0]); //127
                    double latitude2 = Double.parseDouble(splitData2[1]); //37

                    double distance = getDistance(latitude, longitude, latitude2, longitude2);
                    //System.out.println("distance="+distance);

                    if (distance <= 201.0) {
                        //System.out.println("distance="+distance);
                        //testDistance = "distance="+distance+"\n";
                        footbridge_201m_Count++;
                    }
                }

                //db.update_accident_data(accident_many_fid, crosswalk_100m_Count, crosswalk_200m_Count);

                fileline = fileline + ","+footbridge_201m_Count;

                String log3 = i+" accident_many_fid=" + accident_many_fid + " footbridge_201m_Count=" + footbridge_201m_Count;
                //경도 longitude 127,  위도 latitude 37
                System.out.println(log3);
                sbLOG.append(log3);
                sbLOG.append("\n\n===========================================\n\n ");






                // 사고지점 - 육교간 거리 계산 부분.
                for (int j = 0; j <subway_data.size(); j++)
                {
                    String fileline2 = subway_data.get(j);

                    String[] splitData2 = fileline2.split(",");

                    double longitude2 = Double.parseDouble(splitData2[0]); //127
                    double latitude2 = Double.parseDouble(splitData2[1]); //37

                    double distance = getDistance(latitude, longitude, latitude2, longitude2);
                    //System.out.println("distance="+distance);

                    if (distance <= 201.0) {
                        //System.out.println("distance="+distance);
                        //testDistance = "distance="+distance+"\n";
                        subway_201m_Count++;
                    }
                }

                //db.update_accident_data(accident_many_fid, crosswalk_100m_Count, crosswalk_200m_Count);

                fileline = fileline + ","+subway_201m_Count;

                String log4 = i+" accident_many_fid=" + accident_many_fid + " subway_201m_Count=" + subway_201m_Count;
                //경도 longitude 127,  위도 latitude 37
                System.out.println(log4);
                sbLOG.append(log4);
                sbLOG.append("\n\n===========================================\n\n ");



                //수정할 파일 정보를 기록.
                updated_accident_data.add(fileline);


                BufferedWriter fileWriter1 = new BufferedWriter(new OutputStreamWriter(new FileOutputStream("testLOG.txt", true), StandardCharsets.UTF_8));

                //System.out.println("sbLOG.toString().length()="+sbLOG.toString().length());
                fileWriter1.write(sbLOG.toString());
                fileWriter1.close();

                sbLOG = new StringBuilder();

                //동기 방식으로 동작함. db 처리가 오래걸릴 경우, 그만큼 느려짐.
                db.update_accident_data(accident_many_fid, crosswalk_100m_Count, crosswalk_200m_Count, market_201m_Count, library_201m_Count, footbridge_201m_Count, subway_201m_Count);

                //모든 작업 종료.
            }


            StringBuilder updatedFile = new StringBuilder();

            //추가 기록된 부분을 다시 파일로 작성!
            for(int k=0;k<updated_accident_data.size();k++)
            {
                updatedFile.append( updated_accident_data.get(k)+"\n" );
            }

            BufferedWriter fileWriter2 = new BufferedWriter(new OutputStreamWriter(new FileOutputStream("add_data.txt", false), StandardCharsets.UTF_8));

            fileWriter2.write(updatedFile.toString());
            fileWriter2.close();


        } catch (NullPointerException e) {
            System.out.println(e);
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }


        // 16,002,234 = 32133 * 498

        //2km 이내 개수가 45만개.

    } //main 종료


    //경도 longitude 127,  위도 latitude 37
    private static double getDistance(double lat1, double lon1, double lat2, double lon2) {

        double theta = lon1 - lon2;
        double dist = Math.sin(deg2rad(lat1)) * Math.sin(deg2rad(lat2)) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.cos(deg2rad(theta));

        dist = Math.acos(dist);
        dist = rad2deg(dist);
        dist = dist * 60 * 1.1515;

        dist = dist * 1609.344;

        return (dist);
    }


    // This function converts decimal degrees to radians
    private static double deg2rad(double deg) {
        return (deg * Math.PI / 180.0);
    }

    // This function converts radians to decimal degrees
    private static double rad2deg(double rad) {
        return (rad * 180 / Math.PI);
    }
}